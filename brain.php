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
	case 'b':

		if( empty($_GET['a']) || !isset($_GET['a'])) {
			$res =  array('estado' => 404 );
			$response = json_encode($res);

			echo $response;
			exit();
		}

		$ac = $_GET['a'];
		switch ($ac) { //Elige 
			case '1':
				balance_crear();
				break;
			default:
				echo '404';
				break;
		}

		break;
	case 'login': 
		login();
		break;
	
	default:
		echo '404';
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


function balance_crear(){

	//Validar que existan los campos requeridos
	if(!params_check('empresa') || !params_check('fecha_i') || !params_check('fecha_f')){
		$res =  array('estado' => 2,'msg'=>'Rellene todos los campos');
		$response = json_encode($res);

		echo $response;
		exit();
	}

	$empresa = $_POST['empresa'];
	$fecha_i = $_POST['fecha_i'];
	$fecha_f = $_POST['fecha_f'];


	$f_i = strtotime($fecha_i);
	$f_f = strtotime($fecha_f);

	if ($f_i > $f_f) { //Validar fechas
		$res =  array('estado' => 2,'msg'=>'Las fechas son erroneas');
		$response = json_encode($res);

		echo $response;
		exit();
	}

	$db = new MysqliDb();
	$db->where('id',$empresa);
	$r = $db->get('empresa');

	if(count($r)>0){ //Validar que la empresa exista

		$db->where('empresa_id',$empresa);
		$db->where('fecha_inicio_periodo',$fecha_i);
		$db->where('fecha_fin_periodo',$fecha_f);
		$c = $db->get('balance');

		if(count($c)>0){ //Si existe un balance para esa empresa en esas fechas 
			$res =  array('estado' => 2,'msg' => 'Ya existe un balance para ese periodo y empresa' );
			$response = json_encode($res);

			echo $response;
			exit();	
		}

		$nuevo_data = array(
			'empresa_id' => $empresa, 
			'denominacion' => 'MX',
			'fecha_creacion' => date('Y-m-d H-i-s'),
			'fecha_inicio_periodo' => $fecha_i,
			'fecha_fin_periodo' => $fecha_f
		);

		//Se intenta insertar en la base de datos
		$i_id = $db->insert('balance',$nuevo_data); //Regresa el ultimo ID insertado

		if($i_id){ //Si se pudo insertar
			$res =  array('estado' => 1 , 'id'=>$i_id);
			$response = json_encode($res);

			echo $response;
		}else{ //No se puedo crear el balance
			$res =  array('estado' => 2,'msg' => 'No se pudo crear, vuelve a intentar.' );
			$response = json_encode($res);

			echo $response;
		}

	}else{
		$res =  array('estado' => 2,'msg' => 'No existe esa empresa' );
		$response = json_encode($res);

		echo $response;
		exit();
	}

}



function user_logged(){
	if(!isset($_SESSION['admon_usu']) || empty($_SESSION['admon_usu']))
		return false;
	else
		return true;
}


function params_check($param){
	if(!isset($_POST[$param]) || empty($_POST[$param]))
		return false;
	else
		return true;
}





?>