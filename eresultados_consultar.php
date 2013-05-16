<?php
	require_once('libs/db/MysqliDb.php');
	require_once('header.php');


	$db = new MysqliDb();

	$eresultados = $db->get('estado_resultados');
?>
	

	<?php if(count($eresultados)>0){ ?>
		<?= json_encode($eresultados) ?>
	<?php }else{ ?>

		No hay

	<?php } ?>
<?php
	require_once('footer.php');
?>