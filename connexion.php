<!DOCTYPE html>
<html>
<head>
	<title>gestionnaire</title>
</head>
<body>
	<?php

require "inc/functions.php";
require_once("inc/conxbdd.inc.php");
$pdo = connexpdo("marieteam","donbdd");
session();


	
  
    
    if (!empty($_POST) && !empty($_POST['mail']) && !empty($_POST['password'])) {

        require_once("inc/conxbdd.inc.php");
        $pdo = connexpdo("marieteam","donbdd");
        $req = $pdo->prepare("SELECT * from gestionnaire where mailgest = :username");
        $req->execute(array(":username" =>$_POST['mail']));
        $user = $req->fetch();
        if ($_POST['password']==$user['password']) {
            
            $_SESSION['auth']=$user;
            $_SESSION['flash']['success'] = "vous etes bien connectes";
            
            header('location:gestionnaire.php');
            exit();
        }else{
            $_SESSION['flash']['danger'] = 'identifiant ou mot de passe est incorrect';
        }
    }
   


    ?> 
	<form method="POST" action="" role="form">
		<label>mail:</label>
		<input type="mail" name="mail"/>
		<br>
		<label>password:</label>
		<input type="password" name="password"/>
		<br>
		<input type="submit">
		<input type="reset">
	</form>
    <?php if (isset($_SESSION['flash'])):?>
    <?php foreach ($_SESSION['flash'] as $key => $value):?>
                <div class="alert alert-<?= $key;?>">
                    <?=$value;?>
                </div>
    <?php endforeach; ?>
    <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
</body>
</html>