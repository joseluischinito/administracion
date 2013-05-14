<?php
	session_start();

	if(isset($_SESSION['admon_usu']) && !empty($_SESSION['admon_usu'])){
		session_destroy();
	}


	$ROOT = $_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);

	if($_SERVER['SERVER_NAME'] == 'localhost'){
		$ROOT = 'http://'.$ROOT;
	}

	header('Location:'.$ROOT.'/login.php');
?>