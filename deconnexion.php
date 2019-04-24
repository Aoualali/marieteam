<?php
require_once'inc/functions.php';
session();
unset($_SESSION['auth']);
$_SESSION['flash']['success'] = "vous etes maintenant deconnecte";
header("location:index.php");