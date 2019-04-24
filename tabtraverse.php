<?php 
    require_once "inc/conxbdd.inc.php";
    $bdd = connexpdo("marieteam","donbdd");
 ?>
<TABLE BORDER="1">
 <CAPTION> liste des horaires de traversée</CAPTION>
    <tr>
 <th>traversée</th>
 <th>dat</th>
 <th>heure</th>
 <th>bateau</th>
 <th>liaison</th>
    </tr>
<?php
try
{   
$reponse = $bdd->query('SELECT id_traverser,dat,heure,id_bateau,id_liaison FROM traversee');

while ($donnees = $reponse->fetch())
{
  
    echo "</tr>";
    echo "<td> $donnees[id_traverser] </td>";
    echo "<td> $donnees[dat] </td>";
    echo "<td> $donnees[heure] </td>";
    echo "<td> $donnees[id_bateau] </td>";
    echo "<td> $donnees[id_liaison] </td>";
    echo "</tr>";
 
     
}
$reponse->closeCursor();
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
?>
 
<p>formulaire modifier supprimer traversées</p>


<form method="post" action="">
    <input type="number" name="id_traverser">
    <input type="text" name="dat">
    <input type="text" name="heure">
    <input type="number" name="bateau">
    <input type="number" name="id_liaison">
    <input type="submit" name="" value="modifier">
</form>
<?php 
  if (!empty($_POST['id_traverser'])&&!empty($_POST['dat'])&&!empty($_POST['heure'])&&!empty($_POST['bateau'])&&!empty($_POST['id_liaison'])){
 
$id_traverser=$_POST['id_traverser'];
$dat=$_POST['dat'];
$heure=$_POST['heure'];
$bateau=$_POST['bateau'];
$id_liaison=$_POST['id_liaison'];

$stmt = $bdd->prepare("UPDATE traversee SET   heure = :heure, dat = :dat, id_liaison = :id_liaison, id_bateau = :id_bateau WHERE id_traverser = :id_traverser");
    

  $stmt->execute(array(':id_traverser' =>$id_traverser , ':dat'=>$dat, ':heure'=>$heure, ':id_bateau'=> $bateau, ':id_liaison'=> $id_liaison));

 header("location:tabtraverse.php");
  }

?>


<p>pour modifier, remplir l'integralité de la ligne avec les nouvelles valeurs</p>   
<p>supprimer une traversée</p>
<form method="post" action="tabtraverse_supp.php">
    <input type="number" name="id_traverser">
    <input type="submit" value="supprimer">
</form>
<br>
<p>ajouter une traversée</p>


<form method="post" action="tabtraverse_ajout.php">
    <input type="text" name="dat" >
    <input type="text" name="heure" >
    <input type="number" name="bateau" >
    <input type="number" name="id_liaison" >
    <input type="submit" name="" value="ajouter">
</form>
</TABLE>

