<?php
	
	require_once('header.php');
	require_once('libs/db/MysqliDb.php');

	if(!isset($_SESSION['admon_usu']) || empty($_SESSION['admon_usu']) || !isset($_GET['id']) || empty($_GET['id'])){
		header('Location: ./');
		exit();
	}
	
	$db = new MysqliDb();
	$eresultados = $db->query('SELECT estado_resultados.id AS id, estado_resultados.fecha_inicio_periodo AS inicio,  estado_resultados.fecha_fin_periodo AS fin, empresa.nombre AS empresa FROM estado_resultados,empresa WHERE empresa.id = estado_resultados.empresa_id AND estado_resultados.id = '.$_GET['id'].'');


	if(count($eresultados)<=0)
		header('Location: ./');	

?>

<section id="add-form">

	<h1 id="h1-t">Editar Edo de Resultados > Agregar Cuenta </h1>

	<section id="info-estado">
		<p><strong>Empresa: </strong> <?= $eresultados[0]['empresa'] ?> </p>
		<p><strong>Fecha inicio: </strong> <?= date('d M y',strtotime($eresultados[0]['inicio'])) ?> </p>
		<p><strong>Fecha fin: </strong> <?= date('d M y',strtotime($eresultados[0]['fin'])) ?> </p>
	</section>

	<section id="add-movimiento">	

		<form id="form-movimiento" method="POST" action="brain.php?op=e&a=2">

			<section id="cuenta-m">
				<select id="cuentas-t">
					<optgroup label="Activos Fijos">
						<option value="1">Juar Juar</option>
					</optgroup>
					<optgroup label="Pasivos Corto Plazo">
						<option value="2">Jear Jear</option>
					</optgroup>
				</select>

				<input type="text" id="monto-i" name="cantidad" tabindex="1" placeholder="Cantidad" />
			</section>
			<!--
			<section id="cargo-t">
				<input type="radio" id="cargo-c" name="cargo_abono" tabindex="2" value="1" checked />
				<label for="cargo-c">Cargo</label>
				<input type="radio" id="abono-c" name="cargo_abono" value="2" />
				<label for="abono-c">Abono</label>
			</section>-->

			<input type="hidden" id="cta" name="cuenta"/>
			<input type="hidden" name="id_er" value="<?= $eresultados[0]['id'] ?>"/>
			<input type="submit" style="margin-right:0%" value="Agregar" tabindex="4" />

		</form>

	</section>

	<section id="movimientos"></section>

</section>

<div id="popup">
	
</div>

<script src="js/eresultados_edit.js"></script>

<?php
	require_once('footer.php');
?>