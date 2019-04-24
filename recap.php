<!DOCTYPE html>
<html>
<head>
	<title>ok</title>
</head>
<body>
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
        require_once'inc/functions.php';
		require_once "inc/conxbdd.inc.php";  
        session();
        logged_only();
		$pdo = connexpdo("marieteam","donbdd");  
		if (logged_only()) {
     $_SESSION['flash']['danger']="pour reservez vous devez avoir un compte/connecte";
        header('location:index.php');
}                
    	?>


		<?php
      $req1 = "SELECT * from secteur WHERE id_secteur=:sec";
      $req = $pdo->prepare($req1);
      $req->execute(array(':sec' =>$_SESSION['secteur'] ));
      $donne = $req->fetch();

      $req2 = "SELECT * from port WHERE id_port=:portd";
      $req3 = $pdo->prepare($req2);
      $req3->execute(array(':portd' =>$_SESSION['portdepart'] ));
      $donne2 = $req3->fetch();


      $req3 = "SELECT * from port WHERE id_port=:porta";
      $req4 = $pdo->prepare($req3);
      $req4->execute(array(':porta' =>$_SESSION['portarrive'] ));
      $donne3 = $req4->fetch();



echo "<hr>";

			echo "nom: ".$_SESSION['nom'];
			echo "<br>prenom: ".$_SESSION['prenom'];
			echo "<br>mail: ".$_SESSION['mail'];
			echo "<br>tel: ".$_SESSION['tel'];
			echo "<br>adresse: ".$_SESSION['adresse'];
			echo "<br>code postal: ".$_SESSION['cp'];
			echo "<br>ville: ".$_SESSION['ville']."<br>";	
      echo "<hr>";
      echo "<br>secteur: ".$donne['nom']."<br>";   
      echo "<br>port de depart: ".$donne2['nom']."<br>";   
      echo "<br>port d'arriver: ".$donne3['nom']."<br>";   
      echo "<br>date de depart: ".$_SESSION['datedepart']."<br>";   
      echo "<br>heure: ".$_SESSION['heur']."<br>";   
   
echo "<hr>";

	   
		?>
<table style="margin-top: 2em;">
  <tr>
    <th>type</th>
    <th>Tarif en €</th> 
    <th>Quantite</th>
  </tr>

 <?php
        $statementtype = "SELECT * from tarifer,type WHERE tarifer.id_type=type.id_type AND id_traverser=:idt"; 
        $req = $pdo->prepare($statementtype);
        $req -> execute(array(':idt' => $_SESSION['idtraverse']));
        $reqstatementcate = $req->fetchAll();
    	
          $totale = 0;
      
           foreach ($reqstatementcate as $key => $value) {


           echo "<tr >";

                                echo "<td>".$value['libelle']."</td>";
                                echo "<td>".intval($value['tarif'])."</td>";
	                              echo "<td>".intval($_SESSION['qtte'][$key])."</td>";	
                                

	                           				
           echo "</tr>";
    
  
        $totale = $totale + intval($value['tarif'])*intval($_SESSION['qtte'][$key]);
           }
      

        
       



 ?>
</table>
	<?php
		echo "totlale prix a payer : ".$totale."€";
		$_SESSION['prix'] = $totale;

	?>
	<a href="validez.php">PAYER MAINTENANT</a>
</body>
</html>