
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <?php
 require_once'inc/functions.php';
        session();
        logged_only();

        ?>
<?php if (isset($_SESSION['auth'])):?>
                                <li> <a href="logout.php">logout</a></li>
                                <?php else: ?>
                                <li><a href="register.html"><i class="fa fa-user"></i>&nbsp; SIGN UP</a></li>
                                <li><a href="login.html"><i class="fa fa-sign-in"></i>&nbsp; LOGIN</a></li>
                            <?php endif; ?>
</p></body>
</html>

		    <?php
       
       
		require_once "inc/conxbdd.inc.php";
    	$pdo = connexpdo("marieteam","donbdd");
            
    	if (logged_only()) {
     $_SESSION['flash']['danger']="pour reservez vous devez avoir un compte/connecte";
        header('location:index.php');
}
    	else{
  		/*$statementclient = "SELECT mail,id_client FROM client where mail=:email";
        $req = $pdo->prepare($statementclient);
        $req -> execute(array(':email' => $_SESSION['mail']));
 		$reqstatementcate = $req->fetch();*/
        
        $req = $_SESSION['auth']['id_client'];



        $statementreservation = "INSERT INTO reservation (`datereservation`, `id_traverser`, `id_client`,achat) VALUES (now(),:traverser,:client,:achat)";
     	$reqreservation = $pdo->prepare($statementreservation);

        $reqreservation -> execute(array(':traverser'=>$_SESSION['idtraverse'],':client'=>$req,':achat'=>$_SESSION['prix']));


 		$_SESSION['flash']['success']="ok bientot sur notre navire merci d'avoir choisie marieteam un email de confirmation vous a etait envoye";
		mail($_SESSION['email'], 'confirmation de votre compte',"voila votre ticket");      
 		header('location:index.php');


    	}
      
 		  $qt1 = intval($_SESSION['qtte'][0]);
        $statementqttetype = "UPDATE enregistrer  Set quantite=quantite-".$qt1/2." WHERE enregistrer.id_type = 1"; 
        $req = $pdo->query($statementqttetype);
        $req -> execute();

        $qt2 = intval($_SESSION['qtte'][1]); 
         $statementqttetype2 = "UPDATE enregistrer  Set quantite=quantite-'.$qt2.' WHERE id_type = 2"; 
        $req2 = $pdo->query($statementqttetype2);
        $req2 -> execute();


        $qt3 = intval($_SESSION['qtte'][2]);

         $statementqttetype3 = "UPDATE enregistrer  Set quantite=quantite-'.$qt3.' where id_type = 3"; 
        $req3 = $pdo->query($statementqttetype3);
        $req3 -> execute();

        $qt4 = intval($_SESSION['qtte'][3]);


         $statementqttetype4 = "UPDATE enregistrer  Set quantite=quantite-'.$qt4.' WHERE id_type = 4"; 
        $req4 = $pdo->query($statementqttetype4);
        $req4 -> execute();

        $qt5= intval($_SESSION['qtte'][4]);


         $statementqttetype5 = "UPDATE enregistrer  Set quantite=quantite-'.$qt5.' WHERE id_type = 5"; 
        $req5 = $pdo->query($statementqttetype5);
        $req5 -> execute();

        $qt6 = intval($_SESSION['qtte'][5]);


         $statementqttetype6 = "UPDATE enregistrer  Set quantite=quantite-'.$qt6.' WHERE id_type = 6"; 
        $req6 = $pdo->query($statementqttetype6);
        $req6 -> execute();


        $qt7 = intval($_SESSION['qtte'][6]);

         $statementqttetype7 = "UPDATE enregistrer  Set quantite=quantite-'.$qt7.' WHERE id_type = 7"; 
        $req7 = $pdo->query($statementqttetype7);
        $req7 -> execute();

        $qt8 = intval($_SESSION['qtte'][7]);

         $statementqttetype8 = "UPDATE enregistrer  Set quantite=quantite-'.$qt8.' WHERE id_type = 8"; 
        $req8 = $pdo->query($statementqttetype8);
        $req8 -> execute();
?>
<p>ok c'est enregistrer a bientot sur notre bateau</p>
