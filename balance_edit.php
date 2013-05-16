<?php
	require_once('libs/db/MysqliDb.php');
	require_once('header.php');

	$db = new MysqliDb();


?>

<section id="add-form">

	<h1 id="h1-t">Editar Balance General <?= $_GET['id'] ?></h1>



	<section id="info-estado">
		<p><strong>Empresa: </strong> </p>
		<p><strong>Fecha inicio: </strong> </p>
		<p><strong>Fecha fin: </strong> </p>
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

				<input type="text" id="monto-i" name="cantidad">
			</section>

			<section id="cargo-t">
				<input type="radio" id="cargo-c" name="cargo_abono" value="1" checked />
				<label for="cargo-c">Cargo</label>
				<input type="radio" id="abono-c" name="cargo_abono" value="2" />
				<label for="abono-c">Abono</label>
			</section>

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