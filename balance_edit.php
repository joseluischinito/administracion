<?php
	
	require_once('header.php');
	require_once('libs/db/MysqliDb.php');

	if(!isset($_SESSION['admon_usu']) || empty($_SESSION['admon_usu']) || !isset($_GET['id']) || empty($_GET['id'])){
		header('Location: ./');
		exit();
	}
	
	$db = new MysqliDb();
	$balance = $db->query('SELECT balance.id AS id, balance.fecha_inicio_periodo AS inicio,  balance.fecha_fin_periodo AS fin, empresa.nombre AS empresa FROM balance,empresa WHERE empresa.id = balance.empresa_id AND balance.id = '.$_GET['id'].'');

	$db->where('padre_id',1);
	$activos_circulantes = $db->get('cuenta');

	$db->where('padre_id',2);
	$activos_fijos = $db->get('cuenta');

	$db->where('padre_id',3);
	$activos_diferidos = $db->get('cuenta');

	$db->where('padre_id',4);
	$pasivo_c = $db->get('cuenta');

	$db->where('padre_id',5);
	$pasivo_l = $db->get('cuenta');

	$db->where('padre_id',6);
	$capital = $db->get('cuenta');

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

		<form id="form-movimiento" method="POST" action="brain.php?op=b&a=2">

			<section id="cuenta-m">
				<select id="cuentas-t">
					<optgroup label="Activos Cirulantes">
						<?php foreach ($activos_circulantes as $ac) {
							echo '<option value="'.$ac['id'].'">'.$ac['nombre'].'</option>';
						} ?>
					</optgroup>
					<optgroup label="Activos Fijos">
						<?php foreach ($activos_fijos as $ac) {
							echo '<option value="'.$ac['id'].'">'.$ac['nombre'].'</option>';
						} ?>
					</optgroup>
					<optgroup label="Activos Diferidos">
						<?php foreach ($activos_diferidos as $ac) {
							echo '<option value="'.$ac['id'].'">'.$ac['nombre'].'</option>';
						} ?>
					</optgroup>
					<optgroup label="Pasivos a Corto Plazo">
						<?php foreach ($pasivo_c as $ac) {
							echo '<option value="'.$ac['id'].'">'.$ac['nombre'].'</option>';
						} ?>
					</optgroup>
					<optgroup label="Pasivos a Largo Plazo">
						<?php foreach ($pasivo_l as $ac) {
							echo '<option value="'.$ac['id'].'">'.$ac['nombre'].'</option>';
						} ?>
					</optgroup>
					<optgroup label="Capital">
						<?php foreach ($capital as $ac) {
							echo '<option value="'.$ac['id'].'">'.$ac['nombre'].'</option>';
						} ?>
					</optgroup>
				</select>

				<input type="text" id="monto-i" name="cantidad" tabindex="1" placeholder="Cantidad" />
			</section>

			<section id="cargo-t">
				<input type="radio" id="cargo-c" name="cargo_abono" tabindex="2" value="1" checked />
				<label for="cargo-c">Cargo</label>
				<input type="radio" id="abono-c" name="cargo_abono" value="2" />
				<label for="abono-c">Abono</label>
			</section>

			<input type="hidden" id="cta" name="cuenta"/>
			<input type="hidden" name="id_b" value="<?= $balance[0]['id'] ?>"/>
			<input type="submit" style="margin-right:0%" value="Agregar" tabindex="4" />

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