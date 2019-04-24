<?php 
    require_once "inc/conxbdd.inc.php";
    $bdd = connexpdo("marieteam","donbdd");
 ?>

<?php 

if (!empty($_POST['id_traverser'])) {
 
 $id_traverser=$_POST['id_traverser'];


$stmt = $bdd->prepare("DELETE FROM traversee WHERE id_traverser =  :id_traverser");
      
 $stmt->execute(array(':id_traverser' =>$id_traverser));
 header("location:tabtraverse.php");
  

  }
else{
  echo"faux&";

}
    	


 ?>