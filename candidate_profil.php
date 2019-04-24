<!DOCTYPE html>
<html>
<head>
	<title>profil</title>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

</head>
<body>
	<?php 

require_once 'inc/functions.php';
logged_only();
session();
?>
    <?php if (isset($_SESSION['flash'])):?>
                                        <?php foreach ($_SESSION['flash'] as $key => $value):?>
                                                    <div class="alert alert-<?= $key;?>">
                                                        <?=$value;?>
                                                    </div>
                                        <?php endforeach; ?>
                                        <?php unset($_SESSION['flash']); ?>
                                        <?php endif; ?>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="jp_top_header_right_wrapper">
                        <div class="jp_top_header_right_cont">
                            <ul>
                                <?php if (isset($_SESSION['auth'])):?>
                                <li> <a href="deconnexion.php">logout</a></li>
                                <li> <a href="facture.php">consulter ses facture</a></li>
                                <?php else: ?>
                                <li><a href="register.html"><i class="fa fa-user"></i>&nbsp; SIGN UP</a></li>
                                <li><a href="login.html"><i class="fa fa-sign-in"></i>&nbsp; LOGIN</a></li>
                            <?php endif; ?>
                            </ul>
                        </div>
                    
                    </div>
                </div>

                <!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
    <title>saisie des info</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

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
        session();
        logged_only();
    ?>
              <?php
                    require_once "inc/conxbdd.inc.php";
                    $pdo = connexpdo("marieteam","donbdd");
                                           
            ?>
<p>
    Saisir les informations relatives à la réservation : 
</p>
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

<?php
     if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <p>vous n'avez pas remplie le formulaire correctement</p>
            <ol>
            <?php foreach ($errors as $error): ?>
                
                <li>
                    <?= $error; ?>
                </li>

            <?php endforeach; ?>
            </ol>                                        
        </div>
?>

    <?php

                
                $errors = array();
            

                if (empty($_POST['nom'])) {
                  $errors['username'] =  "veuillez saisir votre nom"; 
                }
                else
                {
                  $_SESSION['nom'] = $_POST['nom'];
                }
                if (empty($_POST['prenom'])) {
                  $errors['prenom'] = "veuillez saisir votre prenom";
                }
                else{
                    $_SESSION['prenom'] = $_POST['prenom'];
                }
                if (empty($_POST['mail'])) {
                  $errors['mail'] = "veuillez saisir un mail valide";
                }
                else{
                    $_SESSION['mail'] = $_POST['mail'];

                }
                if (empty($_POST['tel'])) {
                  $errors['tel'] = "veuillez saisir un telephone valide";
                }
                else{
                    $_SESSION['tel'] = $_POST['tel'];
                }
                if (empty($_POST['adresse'])) {
                  $errors['adresse'] = "veuillez saisir une adresse valide";
                }
                else{
                    $_SESSION['adresse'] = $_POST['adresse'];
                }
                if (empty($_POST['cp'])) {
                  $errors['cp'] = "veuillez saisir un code postale";
                }
                else{
                    $_SESSION['cp'] = $_POST['cp'];
                }
                if (empty($_POST['ville'])) {
                  $errors['ville'] = "veuillez saisir une ville valide";
                }else{
                    $_SESSION['ville'] = $_POST['ville'];
                }
                if (empty($_POST['qtte'])) {
                    $errors['qtte'] = "veuillez saisir une quantite valide";
                }
                else{

                    $_SESSION['qtte'] = $_POST['qtte'];
                    header('location:recap.php');

                }
              
 


?>


<?php endif; ?>
<form action="" role="form" method="post">
<p>veuillez remplir les information suivantes</p>
    <input type="text" name="nom" placeholder="Nom" />
    <input type="text" name="prenom" placeholder="prenom" />
    <input type="email" name="mail" placeholder="email" />
    <input type="number" name="tel" placeholder="telephone" />
    <input type="text" name="adresse" placeholder="Adresse" />
    <input type="number" name="cp" placeholder="CP" />
    <input type="text" name="ville" placeholder="Ville" />
<br>  

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
    
          

           foreach ($reqstatementcate as $key => $value) {


           echo "<tr >";
                                echo "<td>".$value['libelle']."</td>";
                                echo "<td>".$value['tarif']."</td>";
                                echo "<td><input type='number' name='qtte[]'/></td>";
           echo "</tr>";
           }
          
       



 ?>
</table>

<input type="submit" value="Valider la réservation" />
</form>
</body>
</html>

</body>
</html>