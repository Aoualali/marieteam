<html>
<meta charset="utf-8">
<body>

  <?php 
    require_once "inc/conxbdd.inc.php";
    $conn = connexpdo("marieteam","donbdd");
 ?>

<?php
  
// set the PDO error mode to exception
    
if (!empty($_POST["dat"])&&!empty($_POST["heure"])&&!empty($_POST["bateau"])&&!empty( $_POST["id_liaison"])) {
    
    $dat = $_POST["dat"]; 

    $heure = $_POST["heure"];
    $bateau = $_POST["bateau"];
    $liaison = $_POST["id_liaison"];


    $stmt = $conn->prepare("INSERT INTO traversee (dat, 
heure, id_bateau, id_liaison) 
VALUES ( :dat, :heure, :bateau, :liaison)");
   

 $stmt->execute(array(':dat' =>$dat , ':heure'=>$heure, ':bateau'=>$bateau, ':liaison'=> $liaison));
// insert a row

header("location:tabtraverse.php");
}

?>


</body>
</html>

