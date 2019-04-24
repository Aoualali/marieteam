<?php
require_once 'inc/functions.php';
require_once "inc/conxbdd.inc.php";            
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
	if (!empty($_POST) && !empty($_POST['email'])) {
		$req = $pdo->prepare('SELECT * FROM client where mail=:email AND confirmed_at IS NOT NULL');
		$req -> execute(array(":email"=>$_POST['email']));
		$user = $req->fetch();

		if ($user) {
			
			$reset_token = str_random(60);
			$pdo->prepare('UPDATE client set reset_token = :reset_token, reset_at = NOW() where id_client = :id')->execute(array(":reset_token"=>$reset_token,":id"=>$user['id_client']));
			$_SESSION['flash']['success'] = 'les instruction du rappel du mot de passe vous ont etait envouye par email ';
			$message = "afin de modifier vos donnees de mot de passe veuillez cliquez http://localhost/marieteam/reset.php?id=".$user['id_client']."&token=".$reset_token;
			mail($_POST['email'], 'reisitialisation du mot de passe', $message);
			header('location:signin.php');
			exit();
		}else{
		
			$_SESSION['flash']['danger'] = "aucun compte ne correspond a cet adresse";
		}
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
							
							
                
                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" role ="form">

							<div class="formsix-pos">
								<div class="form-group i-email">
									<input type="email" class="form-control" name="email" value="<?php if (isset($_POST['email!'])) {echo $_POST['email'];}else{echo '';} ?>" required=""  placeholder="email*">
								</div>
							</div>
							
						
							<div style="text-align: center;">
                                        <button type="submit" class="btn btn-primary login_btn"> envoye </button>
                                        <button type="reset" class="btn btn-danger login_btn"> recommencer </button>
                                    </div>
                        </form>
							<div class="login_message">
								<p>Don’t have an account ? <a href="#"> Register Now </a> </p>
							</div>
						</div>
				
						<!-- /.login_wrapper-->
					</div>
				</div>
			</div>
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