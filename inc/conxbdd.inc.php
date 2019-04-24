<?php

function connexpdo($base,$param){
	include_once($param.".inc.php");
	$dsn = 'mysql:host='.HOST.';dbname='.$base;'charset=utf8';
	$user = USER;
	$pass = PASS;
	try {
		$idcom = new pdo($dsn,$user,$pass,array(PDO::ATTR_PERSISTENT => true));
		$idcom->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		 return $idcom;
		
	} catch (Exception $except) {
		echo "echec de la connexion a la base de donnees".$except->getMessage();
		return FALSE;
		exit();
	}
}




?>