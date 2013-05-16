<?php
	
	require_once('header.php');
	require_once('libs/db/MysqliDb.php');

	if(!isset($_SESSION['admon_usu']) || empty($_SESSION['admon_usu']) || !isset($_GET['id']) || empty($_GET['id'])){
		header('Location: ./');
		exit();
	}
	
	$db = new MysqliDb();
	$balance = $db->query('SELECT balance.id AS id, balance.fecha_inicio_periodo AS inicio,  balance.fecha_fin_periodo AS fin, empresa.nombre AS empresa FROM balance,empresa WHERE empresa.id = balance.empresa_id AND balance.id = '.$_GET['id'].'');


	if(count($balance)<=0)
		header('Location: ./');	

?>

<section id="add-form">

	<h1 id="h1-t">Editar Balance General > Agregar operacion </h1>



	<section id="info-estado">
		<p><strong>Empresa: </strong> <?= $balance[0]['empresa'] ?> </p>
		<p><strong>Fecha inicio: </strong> <?= date('d M y',strtotime($balance[0]['inicio'])) ?> </p>
		<p><strong>Fecha fin: </strong> <?= date('d M y',strtotime($balance[0]['fin'])) ?> </p>
	</section>

	<section id="add-movimiento">	

		<form id="form-movimiento">

			<section id="cuenta-m">
				<select id="cuentas-t">
					<optgroup label="Activos Fijos">
						<option value="1">Juar Juar</option>
					</optgroup>
					<optgroup label="Pasivos Corto Plazo">
						<option value="2">Jear Jear</option>
					</optgroup>
				</select>

				<input type="text" id="monto-i" name="cantidad" placeholder="Cantidad" />
			</section>

			<section id="cargo-t">
				<input type="radio" id="cargo-c" name="cargo_abono" value="1" checked />
				<label for="cargo-c">Cargo</label>
				<input type="radio" id="abono-c" name="cargo_abono" value="2" />
				<label for="abono-c">Abono</label>
			</section>

			<input type="hidden" name="id_b" value="<?= $balance[0]['id'] ?>"/>
			<input type="submit" style="margin-right:0%" value="Agregar" />

		</form>

	</section>

	<section id="movimientos"></section>

</section>

<div id="popup">
	
</div>

<script src="js/balance.js"></script>

<?php
	require_once('footer.php');
?>