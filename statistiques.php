<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<?php 
    require_once "inc/conxbdd.inc.php";
    $bdd = connexpdo("marieteamV2","donbdd");
 ?>

 <TABLE BORDER="1">
 
  <tr>
 <th>nb_reservation</th>
  </tr>
<?php 
  if (!empty($_POST['datedebut'])&&!empty($_POST['datefin'])){
 
 $datedebut=$_POST['datedebut'];
$datefin=$_POST['datefin'];


$stmt = $bdd->prepare("SELECT COUNT(*) AS nb_reser from reservation where datereservation BETWEEN :datedebut AND :datefin");
    

  $stmt->execute(array(':datedebut' =>$datedebut , ':datefin'=>$datefin));
  $donnees=$stmt->fetch();
  echo "<tr>";
  echo "<td> $donnees[nb_reser]</td>";
  echo "</tr>";
  }
else{
  echo"faux2";

}
?>
</TABLE>


<TABLE BORDER="1">

  <tr>
 <th>id_reservation</th>
 <th>datereservation</th>
 <th>id_traverser</th>
 <th>id_client</th>
  </tr>
<?php 
try
{    
   
$reponse = $bdd->query('SELECT * FROM reservation');

while ($donnees = $reponse->fetch())
{
  
    echo "</tr>";
    echo "<td> $donnees[id_reservation] </td>";
    echo "<td> $donnees[datereservation] </td>";
    echo "<td> $donnees[id_traverser] </td>";
    echo "<td> $donnees[id_client] </td>";
    echo "</tr>";
 
     
}
$reponse->closeCursor();
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

?>
</TABLE>

<form method="post" action="">
	<input type="date" name="datedebut">
	<input type="date" name="datefin">
	<input type="submit" name="">
</form>

<TABLE BORDER="1">

  <tr>
 <th>chiffre_affaire</th>
  </tr>
<?php 
  if (!empty($_POST['datedebut'])&&!empty($_POST['datefin'])){
 
 $datedebut=$_POST['datedebut'];
$datefin=$_POST['datefin'];


$stmt = $bdd->prepare("select sum(achat) as CA from reservation WHERE datereservation BETWEEN :datedebut AND :datefin group by id_traverser");
    

  $stmt->execute(array(':datedebut' =>$datedebut , ':datefin'=>$datefin));
  $donnees=$stmt->fetch();
  echo "<tr>";
  echo "<td> $donnees[CA]</td>";
  echo "</tr>";
  }
else{
  echo"faux2";

}
?>
</TABLE>

<h3>nombre de passager</h3>

<TABLE BORDER="1">
 	<CAPTION>nb passager</CAPTION>
  <tr>
 <th>nb passager</th>
 <th>id_traversee</th>
<th>id_categorie</th>
  </tr>
<?php 
  if (!empty($_POST['datedebut'])&&!empty($_POST['datefin'])){
 
 $datedebut=$_POST['datedebut'];
$datefin=$_POST['datefin'];


$stmt = $bdd->prepare("SELECT SUM(quantite) as qtt,id_categorie, id_traversee from enregistrer, traversee WHERE traversee.id_traverser = enregistrer.id_traversee and traversee.dat BETWEEN :datedebut and :datefin GROUP by id_categorie");
    

  $stmt->execute(array(':datedebut' =>$datedebut , ':datefin'=>$datefin));
  

  
  while ($donnees=$stmt->fetch()) {
  echo "<tr>";
  echo "<td>". $donnees["qtt"]."</td>";
  echo "<td>".$donnees["id_traversee"]."</td>";
  echo "<td>". $donnees["id_categorie"]."</td>";
  echo "</tr>";
  }
  
  }
else{
  echo"faux2";

}
?>
</TABLE>



</body>
</html>