<!DOCTYPE html>
<?php
	session_start();
	if (isset($_SESSION['admon_usu']) && !empty($_SESSION['admon_usu'])) {
		$ROOT = $_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);

		if($_SERVER['SERVER_NAME'] == 'localhost'){
			$ROOT = 'http://'.$ROOT;
		}

		header('Location:'.$ROOT);
	}

?>
<html>
<head>

	<meta charset="utf-8" />

	<title>Administracion</title>

	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" href="js/alertify/themes/alertify.core.css" />
	<link rel="stylesheet" href="js/alertify/themes/alertify.bootstrap.css" />

	<script src="js/jquery-2.0.min.js"></script>

	<!--<script src="static/js/ddslick.min.js"></script>-->
	<script src="js/alertify/alertify.min.js"></script>
</head>
<body>

<div id="login">
<header>
	<div id="logo-h">
		<a href=""><img src="imgs/escom.png"/></a>
	</div>
</header>

<section id="form">
	<form method="POST" id="login-form" action="brain.php?op=login">
		<input type="text" name="usr" autocomplete="off" placeholder="Usuario"/>
		<input type="password" name="pwd" placeholder="Contrase&ntilde;a"/>

		<input type="submit" value="Entrar"/>
	</form>
</section>

</div>

<script src="js/login.js"></script>

<?php
	require_once('footer.php');
?>