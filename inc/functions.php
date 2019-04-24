<?php
function debug($variable){
	echo '<pre>'.var_dump($variable,true).'</pre>';

}

function str_random($lenghts){
	$alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
	return substr(str_shuffle(str_repeat($alphabet,$lenghts)),0,$lenghts);

}
function session(){

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
}


function logged_only()
{
 session();
  if (!isset($_SESSION['auth'])) {
    $_SESSION['flash']['danger'] = "vous n'avez pas le droit d'acceder a cette page avant la connexion/inscriptions";
   header('location:index.php');
   exit();
}

}




