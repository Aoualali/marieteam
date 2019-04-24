<?php 
    require_once "inc/conxbdd.inc.php";
    $bdd = connexpdo("marieteam","donbdd");
 ?> 	

<?php 
  if (!empty($_POST['id_liaison'])&&!empty($_POST['distance'])&&!empty($_POST['id_port'])&&!empty($_POST['id_secteur'])&&!empty($_POST['id_port_ARRIVEE'])){
 
 $id_liaison=$_POST['id_liaison'];
$distance=$_POST['distance'];
$id_port=$_POST['id_port'];
$id_secteur=$_POST['id_secteur'];
$id_port_ARRIVEE=$_POST['id_port_ARRIVEE'];

$stmt1 = $bdd->prepare("UPDATE liaison SET  distance = :distance, id_port = :id_port, id_secteur = :id_secteur, id_port_ARRIVEE = :id_port_ARRIVEE WHERE id_liaison = :id_liaison");
    

  $stmt1->execute(array(':id_liaison' =>$id_liaison , ':distance'=>$distance, ':id_port'=>$id_port, ':id_secteur'=> $id_secteur, ':id_port_ARRIVEE'=> $id_port_ARRIVEE));
 

  header("location:liaison.php");
  }
  else{
  	echo "erreur";
  }


?>