<?php 
    require_once "inc/conxbdd.inc.php";
    $bdd = connexpdo("marieteam","donbdd");
 ?>

<?php 

if (isset($_POST['id_liaisons'])) {
 
 $id_liaisons=$_POST['id_liaisons'];


$stmt = $bdd->prepare("DELETE FROM liaison WHERE id_liaison =  :id_liaisons");
      
  $stmt->execute(array(':id_liaisons' =>$id_liaisons));
  header("location:liaison.php");

  }
else{
  echo"faux&";

}
    

 ?>