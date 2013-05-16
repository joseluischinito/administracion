<?php
	require_once('libs/db/MysqliDb.php');
	require_once('header.php');

	$db = new MysqliDb();


?>

<section id="add-form">

	<h1>Editar Estado de Resultados <?= $_GET['id'] ?></h1>

	<section id="info-estado">
		<p><strong>Empresa: </strong> </p>
		<p><strong>Fecha inicio: </strong> </p>
		<p><strong>Fecha fin: </strong> </p>
	</section>

	<section id="add-movimiento">

	</section>

	<section id="movimientos"></section>

</section>

<div id="popup"></div>

<script src="js/balance.js"></script>

<?php
	require_once('footer.php');
?>