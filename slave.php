<?php
class Slave {

	public $array;

	public function makearray($s) {
		$data = explode(":", $s);
		$this->array = array(
				"country" => $data[0],
				"userstring" => $data[1],
				"os" => $data[2],
				"ip" => $data[3],
		);
	}

	public function getTableFormatted() {
		require_once "operatingsystem.php";

		$country = '<img src="images/flags/' . strtolower($this->array['country']) . '.png"> ' . $this->array['country'];
		$userstring = '<b>' . $this->array['userstring'] . '</b>';
		$os = $this->array['os'];
		$osIcon = '<img src="' . OperatingSystem::getIcon($os) . '"> ' . $os;
		$ip = $this->array['ip'];

		return "<td class=%c>" . $country . "</td>\n<td class=%c>" . $userstring . "</td>\n<td class=%c>" . $osIcon . "</td>\n<td class=%c>$ip</td>\n";
	}
}