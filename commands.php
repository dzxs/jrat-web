<?php

require "layout/header.php";

if (isset($_GET['bots'])) {
	$slaves = explode(",", $_GET['bots']);
}

?>

<section class="wrapper scrollable">
	<?php require "layout/menubar.php"; ?>
	<br>

	<div class="col-md-12">
		<div class="panel panel-default panel-block">
			<div class="list-group">
				<div class="list-group-item">
					<div class="form-group">

							<h4 class="section-title">Execute command <?php if (count($slaves) > 0) { echo "(" . count($slaves) . ")"; } ?></h4>
							
							
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php

require "layout/footer.php";

?>