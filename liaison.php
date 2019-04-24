<?php 
    require_once "inc/conxbdd.inc.php";
    $bdd = connexpdo("marieteamV2","donbdd");
 ?>
 
 <TABLE BORDER="1">
 	<CAPTION> liste des liaisons</CAPTION>
  <tr>
 <th>id_liaison</th>
 <th>distance</th>
 <th>id_port</th>
 <th>id_secteur</th>
 <th>id_port_ARRIVEE</th>
  </tr>



<?php 
try
{
      
     
   
$reponse = $bdd->query('SELECT * FROM liaison');

  

while ($donnees = $reponse->fetch())
{
  
    echo "</tr>";
    echo "<td> $donnees[id_liaison] </td>";
    echo "<td> $donnees[distance] </td>";
    echo "<td> $donnees[id_port] </td>";
    echo "<td> $donnees[id_secteur] </td>";
    echo "<td> $donnees[id_port_ARRIVEE] </td>";
    echo "</tr>";
 
     
}
$reponse->closeCursor();
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
?>

  
 <form method="post" action="liaison_modif.php">

    <input type="number" name="id_liaison">
    <input type="number" name="distance">
    <input type="number" name="id_port">
    <input type="number" name="id_secteur">
    <input type="number" name="id_port_ARRIVEE">
    <input type="submit"  value="MODIF">
</form>




<br>


<form method="post" action="liaison_supp.php">
  <input type="number" name="id_liaisons">
  <input type="submit" name="supp" value="supp">
</form>
</TABLE>


<h1>ajouter une nouvelle liaison</h1>

<form method="post" action='liaison_ajouter.php'>
distance <input type="number" name="distance"><br>
port de depart <input type="number" name="id_port"><br>
secteur <input type="number" name="id_secteur"><br>
port d'arrivée <input type="number" name="id_port_ARRIVEE"><br>
<input type="submit">
</form>

