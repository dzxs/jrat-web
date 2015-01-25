<?php
xdebug_disable();

require_once "request.php";

if (isset($_GET['action'])) {
	
} else {
	$request = new Request();
	$sock = $request->createSocket();
	$slaves = $request->getSlaves($sock);	
}

?>

<style type="text/css">
	.tg {
		border-collapse: collapse;
		border-spacing: 0;
		border-color: #aabcfe;
	}
	
	.tg td {
		font-family: Arial, sans-serif;
		font-size: 14px;
		padding: 10px 5px;
		border-style: solid;
		border-width: 1px;
		overflow: hidden;
		word-break: normal;
		border-color: #aabcfe;
		color: #669;
		background-color: #e8edff;
	}
	
	.tg th {
		font-family: Arial, sans-serif;
		font-size: 14px;
		font-weight: normal;
		padding: 10px 5px;
		border-style: solid;
		border-width: 1px;
		overflow: hidden;
		word-break: normal;
		border-color: #aabcfe;
		color: #039;
		background-color: #b9c9fe;
	}
	
	.tg .tg-0ord {
		text-align: right
	}
	
	.tg .tg-ifyx {
		background-color: #D2E4FC;
		text-align: right
	}
	
	.tg .tg-s6z2 {
		text-align: center
	}
	
	.tg .tg-vn4c {
		background-color: #D2E4FC
	}
</style>

<table class="tg">
	<tr>
		<th class="tg-s6z2">Country</th>
		<th class="tg-s6z2">Display Name</th>
		<th class="tg-s6z2">Operating System</th>
		<th class="tg-s6z2">Host</th>
	</tr>

	<?php 
		$i = 1;
		foreach ($slaves as $slave) {
			echo "<tr>" . str_replace("%c", $i++ & 1 ? "tg-vn4c" : "tg-031e", $slave->getTableFormatted()) . "</tr>\n";
		}
	?>
</table>