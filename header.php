<?php
	session_start();
	if (!isset($_SESSION['admon_usu']) || empty($_SESSION['admon_usu'])){
		header('Location:/administracion/login.php');
	}

?>

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8" />

	<title>Administracion</title>

	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="js/alertify/themes/alertify.core.css" />
	<link rel="stylesheet" href="js/alertify/themes/alertify.bootstrap.css" />
	<link rel="stylesheet" href="js/zebra_datepicker/css/zebra_datepicker_metallic.css">
	<link href="js/selectbox/css/jquery.selectbox.css" type="text/css" rel="stylesheet" />

	<link href="js/picker/jquery.fs.picker.css" type="text/css" rel="stylesheet" />



	<script src="js/jquery-2.0.min.js"></script>

	<script src="js/ddSlick/ddslick.min.js"></script>
	


	<script src="js/picker/jquery.fs.picker.min.js"></script>

	<script type="text/javascript" src="js/selectbox/js/jquery.selectbox-0.2.js"></script>
	<script src="js/zebra_datepicker/js/zebra_datepicker_es.js"></script>
	<script src="js/alertify/alertify.min.js"></script>
	<script src="js/spin.min.js"></script>

</head>
<body>
<header>

	<div id="logo-h">
		<a href=""><img src="imgs/escom.png"/></a>
	</div>

<nav>
	<ul>
		<li><a href="/administracion">Inicio</a></li>
		<li><a href="#">Estado de Resultados</a>
			<ul>
				<li><a href="eresultados_consultar.php">Consultar</a></li>
				<li><a href="eresultados_nuevo.php">Nuevo</a></li>
			</ul>
		</li>
		<li><a href="#">Balance General</a>
			<ul>
				<li><a href="balance_consultar.php">Consultar</a></li>
				<li><a href="balance_nuevo.php">Nuevo</a></li>
			</ul>
		</li>

		<li><a href="">Otros</a>
			<ul>
				<li><a href="razones.php">Razones Financieras</a></li>
				<li><a href="origen_aplicacion.php">Estado de Origen y Aplicacion</a></li>
			</ul>
		</li>

		<li style="float:right;"><a href="./logout.php">Salir</a>
	</ul>
</nav>
</header>

<section id="main">