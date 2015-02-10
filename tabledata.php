
<div class="col-md-<?php 
	if (!isset($size)) {
		$size = 5;
	}
	
	echo $size;
?>">
	<div class="panel panel-default panel-block">
		<div class="list-group">
			<div class="list-group-item">
				<div class="form-group">
					<h4 class="section-title">Properties</h4>
					<table class="table table-bordered table-striped">
						<thead class="">
							<tr>
								<th>Key</th>
								<th>Value</th>
							</tr>
						</thead>
						<tbody>

							<?php
								if (!function_exists("printTableData")) {
									function printTableData($string) {
										if ($string == "Nothing found") {
											echo "<td><b><font color='#ff0000'>$string</font></b></td>";
										} else {
											echo "<td>" . $string . "</td>";
										}
									}
								}
							?>
														
							<tr>
								<td>IP</td>
								<?php echo printTableData($slave->getIP()); ?>
							</tr>
							<tr>
								<td>Reverse DNS</td>
								<?php echo printTableData(gethostbyaddr(explode(" / ", $slave->getIP())[0])); ?>
							</tr>
							<tr>
								<td>Identifier</td>
								<?php echo printTableData($slave->getIdentifier()); ?>
							</tr>
							<tr>
								<td>Country</td>
								<?php echo printTableData($slave->getDisplayCountry()); ?>
							</tr>
							<tr>
								<td>Operating System</td>
								<?php echo printTableData($slave->getOperatingSystem()); ?>
							</tr>
							<tr>
								<td>Version</td>
								<?php echo printTableData($slave->getVersion()); ?>
							</tr>
							<tr>
								<td>Ping</td>
								<?php echo printTableData($slave->getPing()); ?>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>