<?php
	require_once('libs/db/MysqliDb.php');
	require_once('header.php');


	$db = new MysqliDb();

	$balances = $db->get('balance');
?>

	<?php if(count($balances)>0){ ?>
		<?= json_encode($balances) ?>
	<?php }else{ ?>

		No hay

	<?php } ?>


<?php
	require_once('footer.php');
?>