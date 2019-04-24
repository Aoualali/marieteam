<?php

$user_id = $_GET['id'];
$token = $_GET['token'];
require_once 'inc/functions.php';
include_once("inc/conxbdd.inc.php");
$pdo = connexpdo("marieteam","donbdd");
session();
$req = $pdo->prepare('SELECT * from client where id_client = :id');
$req ->execute(array(':id'=>$user_id));
$user = $req->fetch();


if ( $user && $user['confirmation_token'] == $token) {
$req = $pdo->prepare("UPDATE client set confirmation_token = null ,confirmed_at=now() where id_client=:id")->execute(array(':id'=>$user_id));
$_SESSION['flash']['success'] = "votre compte a bien etait valide";
$_SESSION['auth'] = $user;
header("location:reserv.php");
}else{
	$_SESSION['flash']['danger']= "ce token n'est pas valide";
	header('location:signin.php');
}