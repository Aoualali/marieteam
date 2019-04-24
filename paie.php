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

	<?php
  	if (logged_only()) {
     $_SESSION['flash']['danger']="pour reservez vous devez avoir un compte/connecte";
        header('location:index.php');
}
    	?>
<p>non prit en charge dans le cahier des charges(gratuit)</p>
<a href="validez.php">reserve!!</a>

</body>
</html>