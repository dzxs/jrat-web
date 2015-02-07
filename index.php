<?php

require_once "request.php";
require_once "countries.php";

$request = new Request();
$sock = $request->createSocket();

$countryStats = $request->getCountryStats($sock);
$request->disconnect($sock);


require_once "layout/header.php";

?>

<section class="wrapper scrollable">
	<?php require_once "layout/menubar.php"; ?>
	<br>

	<section class="widget-group">
		<div class="proton-widget general-stats">
			<div class="panel panel-primary front">
				<div class="panel-heading">
					<i class="icon-sort"></i> <span>Country Stats</span>
				</div>
				<ul class="list-group">

				<?php 
					arsort($countryStats);
					$numberValues = array_values($countryStats);
					for ($i = 0; $i < 5 && $i < count($countryStats); $i++) {
						$number = $numberValues[$i];
						$short = key($countryStats);
						next($countryStats);
						
						$icon = "<img src='images/flags/" . strtolower($short) . ".png'>";
						$displayCountry = Countries::short2long($short);
						
						echo '<li class="list-group-item"><div class="text-holder"><span class="title-text"> ';
						echo $number;;
						echo ' </span> <span class="description-text"> ';
						echo $icon . " " . $displayCountry;
						echo '</span></div> <span class="stat-value"> ';
						echo " + 0 ";
						echo '<i class="icon-sort"></i></span>';
					}
				?>
							
				</ul>
			</div>
		</div>
	</section>
</section>

<?php

require_once "layout/footer.php";

?>