<html>
<meta charset="utf-8">
<body>

  <?php 
    require_once "inc/conxbdd.inc.php";
    $conn = connexpdo("marieteam","donbdd");
 ?>

<?php
  
// set the PDO error mode to exception
    
if (!empty($_POST["distance"])&&!empty($_POST["id_port"])&&!empty($_POST["id_secteur"])&&!empty($_POST["id_port_ARRIVEE"])) {
    $distance = $_POST["distance"];
    $id_port = $_POST["id_port"];
    $id_secteur = $_POST["id_secteur"];
    $id_port_ARRIVEE = $_POST["id_port_ARRIVEE"];
   $stmt = $conn->prepare("INSERT INTO liaison (distance, 
id_port, id_secteur, id_port_ARRIVEE) 
VALUES ( :distance, :id_port, :id_secteur, :id_port_ARRIVEE)");
   

 $stmt->execute(array(':distance' =>$distance , ':id_port'=>$id_port, ':id_secteur'=>$id_secteur, ':id_port_ARRIVEE'=> $id_port_ARRIVEE));



header("location:liaison.php");
}

?>


</body>
</html>

