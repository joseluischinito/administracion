<?php
	require_once('libs/db/MysqliDb.php');
	require_once('header.php');


	$db = new MysqliDb();

	$eresultados = $db->query("SELECT estado_resultados.id as id, estado_resultados.fecha_inicio_periodo as inicio, estado_resultados.fecha_fin_periodo as fin, empresa.nombre as empresa FROM estado_resultados,empresa WHERE empresa.id = estado_resultados.empresa_id");
?>
	
	<section id="registros">
	<?php if(count($eresultados)>0){ ?>

		<div id="rows-t">
			<span class="id-col">ID</span>
			<span class="empresa-col">Empresa</span>
			<span class="inicio-col">Inicio de Periodo</span>
			<span class="fin-col">Fin de Periodo</span>
			<span class="btns-col"></span>
		</div>

		<?php foreach ($eresultados as $row) { ?>
		<article class="row">
			<span class="id-col"><?= $row['id'] ?></span>
			<span class="empresa-col"><?= $row['empresa'] ?></span>
			<span class="inicio-col"><?= date('d,M Y',strtotime($row['inicio'])) ?></span>
			<span class="fin-col"><?= date('d,M Y',strtotime($row['fin'])) ?></span>
			<span class="btns-col">
				<a href="./eresultados_edit.php?id=<?= $row['id'] ?>"><img src="imgs/edit.png" alt="Editar" /></a>
				<a href=""><img src="imgs/x.png" alt="Eliminar" /></a>
			</span>
		</article>
		<?php } ?>

	<?php }else{ ?>

		No hay

	<?php } ?>
	</section>
<?php
	require_once('footer.php');
?>