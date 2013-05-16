<?php
	require_once('libs/db/MysqliDb.php');
	require_once('header.php');


	$db = new MysqliDb();

	$empresas = $db->get('empresa');
?>

<section id="add-form">

	<h1>Nuevo Estado de Resultados</h1>

	<form id="crear-eresultados" action="brain.php?op=e&a=1" method="POST">
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
			<a href="#" id="ae" style="display:block;text-align:right;margin-top:0.5em;">Agregar Empresa</a>
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

<div id="popup-e">

	<section id="add-empresa">
		<h1>Agregar empresa</h1>
		<section id="add-empresa-sib">

			<form id="empresa-nueva" method="POST" action="brain.php?op=ae">
				<input type="text" name="nombre_e" placeholder="Nombre" />
				<input type="submit" value="Agregar" id="ae_btn"/>
				<input type="button" value="Cancelar" id="cancel-emp" />
			</form>

		</section>
	</section>

	<script>
	$(function(){
		$('#empresa-nueva').on('submit',function(e){
			e.preventDefault();
			var self = $(this);
			$.ajax({
				beforeSend: function(){
					$("#ae_btn,#cancel-emp").attr('disabled','disabled');
					$("#ae_btn").val('...');
				},
				type: self.attr('method'),
				url: self.attr('action'),
				data: self.serialize(),
				dataType: 'json',
				success: function(s){
					if(s.estado === 1){
						location.reload();
					}else if(s.estado === 2){
						alertify.alert(s.msg);

						$("#ae_btn,#cancel-emp").removeAttr('disabled');
						$("#ae_btn").val('Agregar');
					}else{
						alertify.alert('No se pudo agregar');

						$("#ae_btn,#cancel-emp").removeAttr('disabled');
						$("#ae_btn").val('Agregar');
					}
				}
			})
		})

		$('#cancel-emp').on('click',function(e){
			e.preventDefault();
			$('#popup-e').fadeOut();
		})
	})
	</script>

</div>

<script src="js/eresultados_nuevo.js"></script>

<?php
	require_once('footer.php');
?>