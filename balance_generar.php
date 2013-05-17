<?php
	
	require_once('libs/db/MysqliDb.php');
	require_once('libs/dompdf/dompdf_config.inc.php');
	session_start();

	if(!isset($_SESSION['admon_usu']) || empty($_SESSION['admon_usu']) || !isset($_GET['id']) || empty($_GET['id'])){
		header('Location: ./');
		exit();
	}

	$db = new MysqliDb();


	$balance_info = $db->query("SELECT empresa.nombre AS empresa,balance.fecha_inicio_periodo AS inicio, balance.fecha_fin_periodo AS fin FROM balance,empresa WHERE balance.empresa_id = empresa.id AND balance.id = {$_GET['id']}");

	if(count($balance_info) <= 0){
		header('Location: ./');
		exit();
	}


	$activo_circulante = $db->query("SELECT t1.nombre as cuenta , SUM(t1.monto_operacion) AS total FROM (SELECT cuenta.nombre AS nombre,cuenta.id,cuenta.activo_pasivo,cuenta.tipo,operaciont.monto_operacion FROM cuenta,operaciont WHERE cuenta.id = operaciont.cuenta_id AND operaciont.balance_id = {$_GET['id']} AND (cuenta.tipo = 1 AND cuenta.activo_pasivo=1) ) AS t1 GROUP BY t1.id");


	$activo_fijo = $db->query("SELECT t1.nombre as cuenta , SUM(t1.monto_operacion) AS total FROM (SELECT cuenta.nombre AS nombre,cuenta.id,cuenta.activo_pasivo,cuenta.tipo,operaciont.monto_operacion FROM cuenta,operaciont WHERE cuenta.id = operaciont.cuenta_id AND operaciont.balance_id = {$_GET['id']} AND (cuenta.tipo = 2 AND cuenta.activo_pasivo=1) ) AS t1 GROUP BY t1.id");

	$activo_diferido = $db->query("SELECT t1.nombre as cuenta , SUM(t1.monto_operacion) AS total FROM (SELECT cuenta.nombre AS nombre,cuenta.id,cuenta.activo_pasivo,cuenta.tipo,operaciont.monto_operacion FROM cuenta,operaciont WHERE cuenta.id = operaciont.cuenta_id AND operaciont.balance_id = {$_GET['id']} AND (cuenta.tipo = 3 AND cuenta.activo_pasivo=1) ) AS t1 GROUP BY t1.id");

	$pasivo_corto = $db->query("SELECT t1.nombre as cuenta , SUM(t1.monto_operacion) AS total FROM (SELECT cuenta.nombre AS nombre,cuenta.id,cuenta.activo_pasivo,cuenta.tipo,operaciont.monto_operacion FROM cuenta,operaciont WHERE cuenta.id = operaciont.cuenta_id AND operaciont.balance_id = {$_GET['id']} AND (cuenta.tipo = 1 AND cuenta.activo_pasivo=2) ) AS t1 GROUP BY t1.id");

	$pasivo_largo = $db->query("SELECT t1.nombre as cuenta , SUM(t1.monto_operacion) AS total FROM (SELECT cuenta.nombre AS nombre,cuenta.id,cuenta.activo_pasivo,cuenta.tipo,operaciont.monto_operacion FROM cuenta,operaciont WHERE cuenta.id = operaciont.cuenta_id AND operaciont.balance_id = {$_GET['id']} AND (cuenta.tipo = 2 AND cuenta.activo_pasivo=2) ) AS t1 GROUP BY t1.id");

	$capital = $db->query("SELECT t1.nombre as cuenta , SUM(t1.monto_operacion) AS total FROM (SELECT cuenta.nombre AS nombre,cuenta.id,cuenta.activo_pasivo,cuenta.tipo,operaciont.monto_operacion FROM cuenta,operaciont WHERE cuenta.id = operaciont.cuenta_id AND operaciont.balance_id = {$_GET['id']} AND (cuenta.tipo = 1 AND cuenta.activo_pasivo=3) ) AS t1 GROUP BY t1.id");


	$t_activo_cirulante = $t_activo_fijo = $t_activo_diferido = 0;
	$t_pasivo_corto = $t_pasivo_largo = $t_capital = 0;
/***

FIN CUENTAS

***/

?>
<?php 
 $html = "<!DOCTYPE html>
<html>
<head>
	<title></title>

	<style>

		*{margin:0;padding:0;}

		#reporte{
			display: block;
			margin: 0 auto;
			width: 80%;
		}

		#informacion{
			display: block;
			margin-top: 3em;
		}

		h1,h2,#reporte-info h3,h4{
			text-align: center;

		}

		.nombre-c{
			display: inline-block;
			width: 80%;
			margin-left: 2%;
		}

		.total-c{
			display: inline-block;
			width: 18%;
			float: right;
			text-align: right;
		}

		.total-cc{
			display: block;
			margin: 1.5em 0% 1.5em 2%;
		}
	</style>
</head>
<body>

	<section id='reporte'>

		<section id='reporte-info'>
			<h1> {$balance_info[0]['empresa']}</h1>
			<h3>Balance General</h3>
			<h4>Del ". date('d M, Y',strtotime($balance_info[0]['inicio']))  ." al ". date('d- M, Y',strtotime($balance_info[0]['fin'])) ." </h4>
		</section>
		<section id='informacion'>
";
			


				if(count($activo_circulante)>0){
					$html.= '<h3 class="b-titulo">Activo Circulante</h3>';

					foreach ($activo_circulante as $c){

						$html.= '<article class="cuenta-a"><span class="nombre-c">'.$c['cuenta'].'</span><span class="total-c">'.$c['total'].'</span></article>';

						$t_activo_cirulante += $c['total'];
					}

				}


				if(count($activo_fijo)>0){
					$html.= '<h3 class="b-titulo">Activo Fijo</h3>';
					foreach ($activo_fijo as $c){

						$html.= '<article class="cuenta-a"><span class="nombre-c">'.$c['cuenta'].'</span><span class="total-c">'.$c['total'].'</span></article>';

						$t_activo_fijo += $c['total'];
					}

				}


				if(count($activo_diferido)>0){
					$html.= '<h3 class="b-titulo">Activo Diferido</h3>';
					foreach ($activo_diferido as $c){

						$html.= '<article class="cuenta-a"><span class="nombre-c">'.$c['cuenta'].'</span><span class="total-c">'.$c['total'].'</span></article>';

						$t_activo_diferido += $c['total'];
					}
				}

				$t_activo = $t_activo_cirulante + $t_activo_diferido + $t_activo_fijo;
				$html.= '<article  class="total-cc"><span style="cuenta-a"><strong>Total Activos</strong></span><span class="total-c">'.$t_activo.'</span></article>';

				if(count($pasivo_corto)>0){
					$html.= '<h3 class="b-titulo">Pasivo a Corto Plazo</h3>';
					foreach ($pasivo_corto as $c){

						$html.= '<article class="cuenta-a"><span class="nombre-c">'.$c['cuenta'].'</span><span class="total-c">'.$c['total'].'</span></article>';

						$t_pasivo_corto += $c['total'];
					}

				}


				if(count($pasivo_largo)>0){
					$html.= '<h3 class="b-titulo">Pasivo a Largo Plazo</h3>';
					foreach ($pasivo_largo as $c){

						$html.= '<article class="cuenta-a"><span class="nombre-c">'.$c['cuenta'].'</span><span class="total-c">'.$c['total'].'</span></article>';

						$t_pasivo_largo += $c['total'];
					}
				}

				$t_pasivo = $t_pasivo_corto + $t_pasivo_largo;
				$html.= '<article  class="total-cc"><span style="cuenta-a"><strong>Total Pasivos</strong></span><span class="total-c">'.$t_pasivo.'</span></article>';

				if(count($capital)>0){
					$html.= '<h3 class="b-titulo">Capital</h3>';
					foreach ($capital as $c){

						$html.= '<article class="cuenta-a"><span class="nombre-c">'.$c['cuenta'].'</span><span class="total-c">'.$c['total'].'</span></article>';

						$t_capital += $c['total'];
					}
				}

				$html.= '<article  class="total-cc"><span style="cuenta-a"><strong>Total capital</strong></span><span class="total-c">'.$t_capital.'</span></article>';



		$html.="

		</section>


		<section id='total-total' style='display:block;margin-top:3em;text-align:center;'>
			<h5>". $t_activo.'  =  '.($t_pasivo +  $t_capital) ."</h5>
		</section>
	</section>

</body>
</html>";

	
	$nombre_pdf = "balance_general-". html_entity_decode( $balance_info[0]['empresa']) .'_'.$balance_info[0]['inicio'].'_'.$balance_info[0]['fin'].'.pdf';

	$dompdf = new DOMPDF();
	$dompdf->load_html($html);
	$dompdf->render();
	$dompdf->stream($nombre_pdf);
?>