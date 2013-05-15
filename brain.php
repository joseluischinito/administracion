<?php
require_once('libs/db/MysqliDb.php');
session_start();


if( empty($_GET['op']) || !isset($_GET['op'] )) {
	$res =  array('estado' => 404 );
	$response = json_encode($res);

	echo $response;
	exit();
}

$op = $_GET['op'];

switch ($op) {
	case 'login':
		login();
		break;
	
	default:
		$ROOT = $_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']);

	if($_SERVER['SERVER_NAME'] == 'localhost'){
		$ROOT = 'http://'.$ROOT;
	}

	header('Location:'.$ROOT.'/login.php');
		break;
}



function login(){

	$res =  array('estado' => 0 );
	if( empty($_POST['usr']) || empty($_POST['pwd']) || !isset($_POST['usr'],$_POST['pwd']) ){
		$response = json_encode($res);

		echo $response;
		exit();
	}elseif (isset($_SESSION['admon_usu']) && !empty($_SESSION['admon_usu'])) {
		$res =  array('estado' => 2 );
		$response = json_encode($res);

		echo $response;
		exit();
	}

	$db = new MysqliDb();
	$db->where('nombre_usuario',$_POST['usr']);
	$db->where('password',md5($_POST['pwd']));
	$rs = $db->get('usuario');

	if(count($rs)>0){
		$res =  array('estado' => 1 );
		$response = json_encode($res);

		$_SESSION['admon_usu'] = $_POST['usr'];

		echo $response;
	}else{
		$res =  array('estado' => 0);
		$response = json_encode($res);

		echo $response;
	}

}










?>