<!DOCTYPE html>
<html>
<head>
	<title>Administracion</title>

	<link rel="stylesheet" type="text/css" href="css/style.css" />

</head>
<body>

<div id="login">
<header>
	<div id="logo-h">
		<a href=""><img src="imgs/escom.png"/></a>
	</div>
</header>

<section id="form">
	<form method="POST" action="brain.php?op=login">
		<input type="text" name="usr" placeholder="Usuario"/>
		<input type="password" name="pwd" placeholder="Contrase&ntilde;a"/>

		<input type="submit" value="Entrar"/>
	</form>
</section>

</div>

<?php
	require_once('footer.php');
?>