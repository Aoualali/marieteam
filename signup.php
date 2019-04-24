<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Sign up - Progressus Bootstrap template</title>

	<link rel="shortcut icon" href="assets/images/gt_favicon.png">
	
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">

	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen" >
	<link rel="stylesheet" href="assets/css/main.css">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	   <?php
        require_once'inc/functions.php';
        session();
    ?>
              <?php
                    require_once "inc/conxbdd.inc.php";
                    $pdo = connexpdo("marieteam","donbdd");
                                           
            ?>
	    <?php
        
              if (!empty($_POST)) {
                
                $errors = array();
       



				//nom
                if (empty($_POST['name'])) {
                    $errors["name"] = "veuillez entrez un nom";
                }
                else{
                    $req = $pdo->prepare("SELECT id_client from client where nom = :nom");
                    $req -> execute(array(':nom'=>$_POST['name']));
                   

                }



                //nom
                if (empty($_POST['prenom'])) {
                    $errors["prenom"] = "veuillez entrez un prenom";
                }
                else{
                    $req = $pdo->prepare("SELECT id_client from client where prenom = :prenom");
                    $req -> execute(array(':prenom'=>$_POST['prenom']));
                   

                }


                //login
                if (empty($_POST['username'])) {
                    $errors["username"] = "veuillez entrez un pseudo";
                }
                else{
                    $req = $pdo->prepare("SELECT id_client from client where login = :login");
                    $req -> execute(array(':login'=>$_POST['username']));
                    $user = $req->fetch();
                    if ($user) {
                        $errors['username']="ce pseudo est deja utilise pour un autre compte";
                    }

                }
                //mail
                
                if (empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
                    $errors["email"] = "votre email est invalide";
                }
                 else{
                    $req = $pdo->prepare("SELECT id_client from client where mail = :mail");
                    $req -> execute(array(':mail'=>$_POST['email']));
                    $user = $req->fetch();
                    if ($user) {
                        $errors['email']="cet email  est deja utilise pour un autre compte";
                    }

                }


//tel
                if (empty($_POST['tel'])) {
                    $errors["tel"] = "veuillez entrez un telephone";
                }
                else{
                    $req = $pdo->prepare("SELECT id_client from client where tel = :tel");
                    $req -> execute(array(':tel'=>$_POST['tel']));
                    $user = $req->fetch();
                    if ($user) {
                        $errors['tel']="ce tel est deja utilise pour un autre compte";
                    }

                }
//adresse
                 if (empty($_POST['adresse'])) {
                    $errors["adresse"] = "veuillez entrez une adresse";
                }
                else{
                    $req = $pdo->prepare("SELECT id_client from client where adresse = :adresse");
                    $req -> execute(array(':adresse'=>$_POST['adresse']));
                   

                }

                //code postale
                 if (empty($_POST['cp'])) {
                    $errors["cp"] = "veuillez entrez un code postale";
                }
                else{
                    $req = $pdo->prepare("SELECT id_client from client where codepostal = :cp");
                    $req -> execute(array(':cp'=>$_POST['cp']));
                   

                }
                   if (empty($_POST['ville'])) {
                    $errors["ville"] = "veuillez entrez la ville";
                }
                else{
                    $req = $pdo->prepare("SELECT id_client from client where ville = :ville");
                    $req -> execute(array(':ville'=>$_POST['ville']));
                   

                }

                if (empty($_POST['cgu'])) {
                    $errors["cgu"] = "veuillez acceptez les condition general d'utilisation";
                }
                else{
                    $req = $pdo->prepare("SELECT id_client from client where cgu = :cgu");
                    $req -> execute(array(':cgu'=>$_POST['cgu']));
                 
                }
 
                if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
                    $errors["password"] = "vous devez entrez un mdp valide";
                }
               
                
                if (empty($errors)) {
          
                        $req = $pdo ->prepare ("INSERT INTO `client` ( `nom`, `prenom`, `mail`, `tel`, `adresse`, `codepostal`, `ville`, `login`, `mdp`,confirmation_token,cgu) VALUES (:nom,:prenom,:mail,:tel,:adresse,:code,:ville,:login,:mdp,:confirmation_token,:cgu)");
                        $pass = password_hash($_POST['password'],PASSWORD_BCRYPT);
                        $token = str_random(60);
                        $req->execute(
                            array
                            (
                            ':nom'=>$_POST['name'],
                            ':prenom'=>$_POST['prenom'],
                            ':mail'=>$_POST['email'],
                            ':tel'=>$_POST['tel'],
                            ':adresse'=>$_POST['adresse'],
                            ':code'=>$_POST['cp'],
                            ':ville'=>$_POST['ville'],
                            ':login'=>$_POST['username'],
                            ':mdp'=>$pass,
                            ':confirmation_token'=>$token,
                            ':cgu'=>$_POST['cgu']

                            )
                        );
                        $user_id = $pdo->LastInsertId();
                        
                        $_SESSION['flash']['success'] = "un email de confirmation vous a etait envoye";
                        $mes  =  "<a href='http://localhost/marieteam/confirm.php?id=".$user_id."&token=".$token."'>ici</a>";
                        mail($_POST['email'], 'confirmation de votre compte',"afin de validez votre compte merci de cliquez: ".$mes);      
                        header('location:signin.php');
                exit();
                }
                
        }

        
       
?>
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top headroom" >
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="index.html"><img src="assets/images/logo.png" alt="Progressus HTML5 template"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<li><a href="index.html">Home</a></li>
					<li><a href="about.html">About</a></li>
					
					<li><a href="contact.html">Contact</a></li>
					<li class="active"><a class="btn" href="signin.html">SIGN IN / SIGN UP</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div> 
	<!-- /.navbar -->

	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="container">

		<ol class="breadcrumb">
			<li><a href="index.html">Home</a></li>
			<li class="active">Registration</li>
		</ol>

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Registration</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Register a new account</h3>
							<p class="text-center text-muted">Lorem ipsum dolor sit amet, <a href="signin.php">Login</a> adipisicing elit. Quo nulla quibusdam cum doloremque incidunt nemo sunt a tenetur omnis odio. </p>
							<hr>
 							<?php if (!empty($errors)): ?>
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
							<?php endif; ?>


 							<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" role = "form">
                                      

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" name="name" value="<?php if (isset($_POST['name'])) {echo $_POST['name'];}else{echo '';} ?>" placeholder="nom*" >
                                        </div>


                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" name="prenom" value="<?php if (isset($_POST['prenom'])) {echo $_POST['prenom'];}else{echo '';} ?>" placeholder="prenom*" >
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" name="username" value="<?php if (isset($_POST['username'])) {echo $_POST['username'];}else{echo '';} ?>" placeholder="pseudo*" >
                                        </div>

                                        <!--Form Group-->
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <input type="email" name="email" value="<?php if (isset($_POST['email'])) {echo $_POST['email'];}else{echo '';} ?>" placeholder="Email*" >
                                        </div>

  										<div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <input type="telephone" name="tel" value="<?php if (isset($_POST['tel'])) {echo $_POST['tel'];}else{echo '';} ?>" placeholder="telephone*" >
                                        </div>


                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" name="adresse" value="<?php if (isset($_POST['adresse'])) {echo $_POST['adresse'];}else{echo '';} ?>" placeholder="Adresse*" >
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <input type="number" name="cp" value="<?php if (isset($_POST['cp'])) {echo $_POST['cp'];}else{echo '';} ?>" placeholder="code postal*" >
                                        </div>

                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" name="ville" value="<?php if (isset($_POST['ville'])) {echo $_POST['ville'];}else{echo '';} ?>" placeholder="ville*" >
                                        </div>



                                        <!--Form Group-->
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">

                                            <input type="password" name="password" value="<?php if (isset($_POST['Username'])) {echo $_POST['password'];}else{echo '';} ?>" placeholder=" password*" >
                                        </div>
                                        <!--Form Group-->
                                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                            <input type="password" name="password_confirm" value="" placeholder="re-enter password*" >
                                        </div>
                                     

                                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="check-box text-center">
                                                <input type="radio" name="cgu" value="acc" id="account-option_1"> &ensp;
                                                <label for="account-option_1">I agreed to the <a href="condition.html" class="check_box_anchr">Terms and Conditions</a> governing the use of jobportal</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="text-align: center;">
                                        <button type="submit" class="btn btn-primary login_btn"> enregistrer </button>
                                        <button type="reset" class="btn btn-danger login_btn"> recommencer </button>
                                    </div>
                            </form>
							
						</div>
					</div>

				</div>
				
			</article>
			<!-- /Article -->

		</div>
	</div>	<!-- /container -->
	

	<footer id="footer" class="top-space">

		<div class="footer1">
			<div class="container">
				<div class="row">
					
					<div class="col-md-3 widget">
						<h3 class="widget-title">Contact</h3>
						<div class="widget-body">
							<p>+234 23 9873237<br>
								<a href="mailto:#">some.email@somewhere.com</a><br>
								<br>
								234 Hidden Pond Road, Ashland City, TN 37015
							</p>	
						</div>
					</div>

					<div class="col-md-3 widget">
						<h3 class="widget-title">Follow me</h3>
						<div class="widget-body">
							<p class="follow-me-icons clearfix">
								<a href=""><i class="fa fa-twitter fa-2"></i></a>
								<a href=""><i class="fa fa-dribbble fa-2"></i></a>
								<a href=""><i class="fa fa-github fa-2"></i></a>
								<a href=""><i class="fa fa-facebook fa-2"></i></a>
							</p>	
						</div>
					</div>

					<div class="col-md-6 widget">
						<h3 class="widget-title">Text widget</h3>
						<div class="widget-body">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, dolores, quibusdam architecto voluptatem amet fugiat nesciunt placeat provident cumque accusamus itaque voluptate modi quidem dolore optio velit hic iusto vero praesentium repellat commodi ad id expedita cupiditate repellendus possimus unde?</p>
							<p>Eius consequatur nihil quibusdam! Laborum, rerum, quis, inventore ipsa autem repellat provident assumenda labore soluta minima alias temporibus facere distinctio quas adipisci nam sunt explicabo officia tenetur at ea quos doloribus dolorum voluptate reprehenderit architecto sint libero illo et hic.</p>
						</div>
					</div>

				</div> <!-- /row of widgets -->
			</div>
		</div>

		<div class="footer2">
			<div class="container">
				<div class="row">
					
					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="simplenav">
								<a href="#">Home</a> | 
								<a href="about.html">About</a> |
								<a href="sidebar-right.html">Sidebar</a> |
								<a href="contact.html">Contact</a> |
								<b><a href="signup.html">Sign up</a></b>
							</p>
						</div>
					</div>

					<div class="col-md-6 widget">
						<div class="widget-body">
							<p class="text-right">
								Copyright &copy; 2014, Your name. Designed by <a href="http://gettemplate.com/" rel="designer">gettemplate</a> 
							</p>
						</div>
					</div>

				</div> <!-- /row of widgets -->
			</div>
		</div>
	</footer>	
		




	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="assets/js/headroom.min.js"></script>
	<script src="assets/js/jQuery.headroom.min.js"></script>
	<script src="assets/js/template.js"></script>
</body>
</html>