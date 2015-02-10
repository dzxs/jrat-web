<?php

if (isset($_GET['id'])) {
	$id = $_GET['id'];
} else {
	goto notfound;
}

require_once "slave.php";
require_once "request.php";

$request = new Request();
$sock = $request->createSocket();
$slaves = $request->getSlaves();

foreach ($slaves as $aslave) {
	if ($aslave->getUniqueId() == $id) {
		$slave = $aslave;
	}
}

$request->disconnect();

if (!isset($slave)) {
	notfound:
	header("Location: search.php");
	exit();
}

require_once "layout/header.php";

?>

<section class="wrapper scrollable">
	<?php require_once "layout/menubar.php"; ?>
	<br>
	<?php
		require "tabledata.php";
	?>
</section>


<?php
require_once "layout/footer.php";
?>