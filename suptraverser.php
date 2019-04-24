<?php


        require_once'inc/functions.php';
        session();
        require_once "inc/conxbdd.inc.php";
        $pdo = connexpdo("marieteam","donbdd");
        $message = "";
        $statement = "DELETE FROM traversee WHERE datediff(traversee.dat,CURRENT_DATE)<0";
        $req = $pdo->query($statement);
        $req->execute();
        if (!$req) {
        	$message = "aucune traversee supprimer";
        }
        else {
        	$message = "traitement reussie";
        }

        echo $message;
       