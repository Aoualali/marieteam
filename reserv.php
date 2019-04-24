
    <?php
        require_once'inc/functions.php';
        session();
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>reservation</title>
</head>
<body>
    <body class="home">
    <style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 5px;
  text-align: left;    
}
</style>
    <?php
if (!$_SESSION) {
        $_SESSION['flash']['danger']="vous n'avez pas le droit d'acceder a cette page";
        header('location:index.php');

      }
elseif (logged_only()) {
     $_SESSION['flash']['danger']="pour reservez vous devez avoir un compte/connecte";
        header('location:index.php');
}
?>
<?php if (isset($_SESSION['flash'])):?>
    <?php foreach ($_SESSION['flash'] as $key => $value):?>
                <div class="alert alert-<?= $key;?>">
                    <?=$value;?>
                </div>
    <?php endforeach; ?>
    <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
     <p style="text-align: left; color: red;">veuilez selectionnez les different formulaire<br>si le  formulaire apparait mais qu'il n'y a aucune donnees corespondante alors cela veut dire qu'aucune traversee n'est organise<br>ou alors si le formulaire revient sur le choix du secteur</p>
          <ul>
   <li>Selectionnez le secteur</li>
   <li>Selectionnez le port de depart</li> 
   <li>Selectionnez le port d'arriver</li> 
   <li>Selectionnez la date de depart</li> 
   <li>Selectionnez l'heure</li> 

</ul>
    <section style="text-align: center; margin-top: 5em;">

            <?php
                    require_once "inc/conxbdd.inc.php";
                    $pdo = connexpdo("marieteam","donbdd");
                                           
            ?>

<?php if(!empty($_POST['secteur'])) {
        $_SESSION['secteur'] = $_POST['secteur']; 
?>
    <form method="post" action="">
        <?php
                $statement2 = "SELECT liaison.id_port,nom FROM liaison,port where liaison.id_port=port.id_port AND id_secteur=:id1";
                $req2 = $pdo->prepare($statement2);
                $req2 ->execute(array(':id1'=>$_SESSION['secteur']));
                echo "<select name='portdepart'>
               ";
                    foreach ($req2 as $value) {
                        echo "<option  value=".$value['id_port'].">".$value['nom']."</option>";
                    }
                echo "</select>";
        ?>
        <button type="submit">Valider</button>
    </form>
<?php 
} 
elseif(isset($_POST['portdepart'])) 
{
        $_SESSION['portdepart'] = $_POST['portdepart']; ?>

    <form method="post" action="">

        <?php

                $statement3 = "SELECT liaison.id_port_ARRIVEE,nom FROM liaison,port where liaison.id_port_ARRIVEE=port.id_port AND liaison.id_port=:id2";
                $req3 = $pdo->prepare($statement3);
                $req3 ->execute(array(':id2'=>$_SESSION['portdepart']));
                echo "<select name='portarrive'>
               ";
                foreach ($req3 as $value) {
                    echo "<option value=".$value['id_port_ARRIVEE'].">".$value['nom']."</option>";
                }
                echo "</select>";
        ?>

        <button type="submit">Valider</button>
    </form>


<?php } elseif(!empty($_POST['portarrive'])) {
        $_SESSION['portarrive'] = $_POST['portarrive'];
        ?>
 <form method="post" action="">

        <?php

               $statement4 = "SELECT * FROM liaison,traversee  WHERE liaison.id_liaison=traversee.id_liaison AND liaison.id_port=:idport AND liaison.id_port_ARRIVEE=:idportarrive AND liaison.id_secteur=:idsec";
                $req4 = $pdo->prepare($statement4);
                $req4->execute(array(':idport'=> $_SESSION['portdepart'],':idportarrive' =>$_SESSION['portarrive'],':idsec' =>$_SESSION['secteur']));
                echo "<select name='datedepart'>
               ";
                while ($donnee = $req4->fetch()) { 
                    echo "<option value=".$donnee['dat'].">".$donnee['dat']."</option>";
                }
                echo "</select>";
        ?>

        <button type="submit">Valider</button>
    </form>


<?php 
} 
elseif(isset($_POST['datedepart'])) 
{
        $_SESSION['datedepart'] = $_POST['datedepart']; ?>

    <form method="post" action="">

        <?php

               $statement5 = "SELECT id_traverser,heure FROM liaison,traversee  WHERE liaison.id_liaison=traversee.id_liaison AND liaison.id_port=:idport AND liaison.id_port_ARRIVEE=:idportarrive AND liaison.id_secteur=:idsec AND dat=:dat";
                $req5 = $pdo->prepare($statement5);
                $req5->execute(array(':idport' =>$_SESSION['portdepart'] ,':idportarrive' =>$_SESSION['portarrive'],':idsec' =>$_SESSION['secteur'],':dat' =>$_SESSION['datedepart']));
                echo "<select name='heur'>
             ";
                while ($donnee = $req5->fetch()) {
                    echo "<option value=".$donnee['heure'].">".$donnee['heure']."</option>";
                }
                echo "</select>";
        ?>

        <button type="submit">Valider</button>
    </form>
<?php
} elseif(isset($_POST['heur'])) {
    $_SESSION['heur'] = $_POST['heur'];
    if (isset($_SESSION)) {

    $statement1 = "SELECT * from secteur where id_secteur=:id";
    $req1 = $pdo->prepare($statement1);
    $req1 -> execute(array(':id' => $_SESSION['secteur']));
    $reqstatement1 = $req1->fetch(); 
    echo "secteur :".$reqstatement1['nom']."<br>"; 

    $statement2 = "SELECT * from port where id_port=:id";
    $req2 = $pdo->prepare($statement2);
    $req2 -> execute(array(':id' => $_SESSION['portdepart']));
    $reqstatement2 = $req2->fetch(); 
    echo "port de depart :".$reqstatement2['nom']."<br>"; 

    $statement3 = "SELECT * from port,liaison where liaison.id_port_ARRIVEE=port.id_port AND  id_port_ARRIVEE=:id";
    $req3 = $pdo->prepare($statement3);
    $req3 -> execute(array(':id' => $_SESSION['portarrive']));
    $reqstatement3 = $req3->fetch(); 
    echo "port d'arrive :".$reqstatement3['nom']."<br>"; 


    $statement4 = "SELECT * from traversee,liaison where liaison.id_liaison=traversee.id_liaison AND dat=:id";
    $req4 = $pdo->prepare($statement4);
    $req4 -> execute(array(':id' => $_SESSION['datedepart']));
    $reqstatement4 = $req4->fetch(); 
    echo "date de depart :".$reqstatement4['dat']."<br>";

    $statement5 = "SELECT * from traversee,liaison where liaison.id_liaison=traversee.id_liaison AND heure=:id";
    $req5 = $pdo->prepare($statement5);
    $req5 -> execute(array(':id' => $_SESSION['heur']));
    $reqstatement5 = $req5->fetch(); 
    echo "heur de depart :".$reqstatement5['heure']."<br>";


    $statement = "SELECT traversee.id_bateau,id_traverser,bateau.libelle from traversee,liaison,bateau where liaison.id_liaison=traversee.id_liaison AND traversee.id_bateau=bateau.id_bateau AND id_secteur=:secteur AND dat=:datedepart AND id_port_ARRIVEE=:portarrive AND id_port=:portdepart AND heure=:heur ";
    $req = $pdo->prepare($statement);
    $req -> execute(array(':secteur' => $_SESSION['secteur'],':portdepart' => $_SESSION['portdepart'], ':portarrive' => $_SESSION['portarrive'],':datedepart' => $_SESSION['datedepart'],':heur' => $_SESSION['heur']));
    $reqstatement = $req->fetch(); 
   $_SESSION['idtraverse'] = $reqstatement['id_traverser'];



    
$reqplace="SELECT SUM(enregistrer.quantite) as quantite from enregistrer WHERE enregistrer.id_traverser=1  and enregistrer.id_categorie=1";
    $reqpcategorie = $pdo->prepare($reqplace);
    $reqpcategorie -> execute(array(':id' => $reqstatement['id_traverser']));
    $reqstatementcate = $reqpcategorie->fetch();

$reqplace2="SELECT SUM(enregistrer.quantite) as quantite from enregistrer WHERE enregistrer.id_traverser=1  and enregistrer.id_categorie=2";
    $reqpcategorie2 = $pdo->prepare($reqplace2);
    $reqpcategorie2 -> execute(array(':id' => $reqstatement['id_traverser']));
    $reqstatementcate2 = $reqpcategorie2->fetch();

$reqplace3="SELECT SUM(enregistrer.quantite) as quantite from enregistrer WHERE enregistrer.id_traverser=1  and enregistrer.id_categorie=3";
    $reqpcategorie3 = $pdo->prepare($reqplace3);
    $reqpcategorie3 -> execute(array(':id' => $reqstatement['id_traverser']));
    $reqstatementcate3 = $reqpcategorie3->fetch();



  
                           echo  
                               "<table style='width:100%'>
                                              <tr>
                                                <th colspan='2'>traversee</th>
                                                <th colspan='3'>place dispo par categories</th>
                                              </tr>
                                              <tr>
                                                <td>code</td>
                                                <td>bateau</td>
                                                <td>A passagers</td>
                                                <td>B Vehicule inf 2m</td>
                                                <td>C Vehicule sup 2m</td>
                                              </tr>
                                              <tr>
                                               <td>";
                                               echo $reqstatement['id_traverser'];
                                               echo "</td><td>";
                                               echo $reqstatement['libelle'];
                                               echo "</td>";

                                                
                                                    echo "<td>".$reqstatementcate['quantite']."</td>";
                                                    echo "<td>".$reqstatementcate2['quantite']."</td>";
                                                    echo "<td>".$reqstatementcate3['quantite']."</td>";

                                                
                                                echo "<td><a href='reservation.php'>reserver</a></td>";
                                              
                                               echo "</tr></table>";
                                            
?>     
<?php

        }
       else{
        $_SESSION['flash']['danger']="aucune donnee rentre dans les listes deroulante ";
       }




} 

 else { ?>

    <form method="post" action="">
        <?php
                            
                $statement1 = "SELECT * FROM secteur";
                $req = $pdo->query($statement1);
                echo "<select name='secteur'>
               ";
                foreach ($req as $value) {
                    echo "<option value=".$value['id_secteur'].">".$value['nom']."</option>";
                }
                echo "</select>";                                       
                                    
        ?>
  
        <button type="submit">Valider</button>
    </form>

<?php } ?>

</section>


</body>
</html>