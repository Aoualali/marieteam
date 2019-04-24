<!DOCTYPE html>
<html>
<head>
	<title>gestionnaire</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
	<?php

require "inc/functions.php";
require_once("inc/conxbdd.inc.php");
$pdo = connexpdo("marieteam","donbdd");
session();
logged_only();
   ?> 
   	<h1>Affichage des elements recherche pour la mise en page</h1>
   	    <?php if (isset($_SESSION['flash'])):?>
    <?php foreach ($_SESSION['flash'] as $key => $value):?>
                <div class="alert alert-<?= $key;?>">
                    <?=$value;?>
                </div>
    <?php endforeach; ?>
    <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['auth'])):?>


                                <li> <a href="deconnexion.php">logout</a></li>
                                <li> <a href="liaison.php">ajouter/modifier une liaison</a></li>
                                <li> <a href="tabtraverse.php">ajouter/modifier une traverse</a></li>
                                <li> <a href="statistiques.php">Stats</a></li>


                                <li><a href="suptraverser.php">supprimer une traverse</a></li>
                                <li><a href="point.php">point de fidelite</a></li>
                                <li><a href="place.php">nombre de places</a></li>


    <?php endif; ?>
  

</body>
</html>