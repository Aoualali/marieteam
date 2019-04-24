<?php
require_once 'inc/functions.php';
require_once("inc/conxbdd.inc.php");                      
$pdo = connexpdo("marieteam","donbdd");
session();
?>

<!DOCTYPE html>
<!-- 
Template Name: Job Pro
Version: 1.0.0
Author: 
Website: 
Purchase: 
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="fr">
<!--<![endif]-->

<head>
    <meta charset="utf-8" />
    <title></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content="Job Pro" />
    <meta name="keywords" content="Job Pro" />
    <meta name="author" content="" />
    <meta name="MobileOptimized" content="320" />
    <!--srart theme style -->
    <link rel="stylesheet" type="text/css" href="css/animate.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="css/fonts.css" />
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="css/owl.theme.default.css" />
    <link rel="stylesheet" type="text/css" href="css/flaticon.css" />
    <link rel="stylesheet" type="text/css" href="css/style_II.css" />
    <link rel="stylesheet" type="text/css" href="css/responsive2.css" />
    <!-- favicon links -->
    <link rel="shortcut icon" type="image/png" href="images/header/favicon.ico" />
</head>
<body>
<?php

		if(isset($_GET['id']) && isset($_GET['token'])) {
			$req = $pdo->prepare('SELECT * FROM client where id_client=:id AND reset_token IS NOT NULL AND reset_token = :reset_token and reset_at > DATE_SUB(NOW(),INTERVAL 30 MINUTE)');
		 	$req->execute(array(":id"=>$_GET["id"],":reset_token"=>$_GET['token']));
		 	$user = $req->fetch();
		 	if ($user) {

		 		if (!empty($_POST)) {
		 			if (!empty($_POST['password']) && $_POST['password'] == $_POST["password_confirm"]) {
		 				echo "ok";
		 				$password = password_hash($_POST["password"],PASSWORD_BCRYPT);
		 				$pdo->prepare("UPDATE client set mdp =:mdp , reset_at = NULL , reset_token = NULL  ")->execute(array(":mdp"=>$password));
		 				session_start();
		 				$_SESSION['flash']['success'] = "votre mot de passe a etait modifier";
		 				$_SESSION['auth'] = $user;
		 				header('location:candidate_profil.php');
		 				exit();
		 			}
		 		}
		 	}else{
		 		$_SESSION['flash']['danger']="ce token n'est pas valide";
		 		header('location:signin.php');
		 		exit();
		 	}
		 }else{
		 	echo "pas ok";
		 }

	?>
<div class="login_section">
		<!-- login_form_wrapper -->
		<div class="login_form_wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<!-- login_wrapper -->
						<h1>LOGIN TO YOUR ACCOUNT</h1>
						<div class="login_wrapper">

                           <?php if (isset($_SESSION['flash'])):?>
                        <?php foreach ($_SESSION['flash'] as $key => $value):?>
                                    <div class="alert alert-<?= $key;?>">
                                        <?=$value;?>
                                    </div>
                        <?php endforeach; ?>
                        <?php unset($_SESSION['flash']); ?>
                        <?php endif; ?>
                        <form action="" method="POST" role ="form">

								<div class="formsix-e">
								<div class="form-group i-password">
									<input type="password" class="form-control" name="password"  id="password" placeholder="nouveau mot de passe">
								</div>
							</div>
							<div class="formsix-e">
								<div class="form-group i-password">
									<input type="password" class="form-control" name="password_confirm"  id="password2" placeholder="confirmation du mot de passe">
								</div>
							</div>
							
							<div style="text-align: center;">
                                        <button type="submit" class="btn btn-primary login_btn"> enregistrer </button>
                                        <button type="reset" class="btn btn-danger login_btn"> recommencer </button>
                                    </div>
                        </form>
							
						</div>
					
						<!-- /.login_wrapper-->
					</div>
				</div>
			</div>
		</div>
		<!-- /.login_form_wrapper-->
	</div>
							<!--main js file start-->
    <script src="js/jquery_min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery.menu-aim.js"></script>
    <script src="js/jquery.countTo.js"></script>
    <script src="js/jquery.inview.min.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/jquery.magnific-popup.js"></script>
    <script src="js/custom_II.js"></script>
</body>
</html>