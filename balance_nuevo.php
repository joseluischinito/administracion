<?php
	require_once('libs/db/MysqliDb.php');
	require_once('header.php');


	$db = new MysqliDb();

	$empresas = $db->get('empresa');
?>

<section id="add-form">

	<h1>Nuevo Balance General</h1>

	<form id="crear-balance" action="brain.php?op=b&a=1" method="POST">
		<div id="sead-empresa">
			<select id="empresa">
				<?php if(count($empresas)>0){ ?>
					<option value="x">Selecciona una empresa</option>
				<?php
					foreach ($empresas as $empresa)
						echo "<option value='{$empresa['id']}'>{$empresa['nombre']}</option> \n\t";
				} else{  ?>
					<option>No hay empresas</option>
				<?php  } ?>
			</select>
		</div>
			
		<div id="fechas-1">
			<input type="text" id="fecha_inicio" name="fecha_i" placeholder="Inicio de Periodo"/>
			<input type="text" id="fecha_fin" name="fecha_f" placeholder="Fin de Periodo"/>
			<input type="hidden" id="empr_id" name="empresa" />
		</div>

		<input type="submit" value="Crear">
	</form>
</section>

<div id="popup"></div>

<script src="js/balance.js"></script>

<?php
	require_once('footer.php');
?>