<?php

require_once "operatingsystem.php";
require_once "countries.php";

class Slave {

	public $array;

	public function makearray($s) {
		$data = explode(":", $s);
		$this->array = array(
				"id" => $data[0],
				"selected" => $data[1],
				"country" => $data[2],
				"userstring" => $data[3],
				"os" => $data[4],
				"ip" => $data[5],
				"version" => $data[6],
				"ping" => $data[7],
		);
	}

	public function getUniqueId() {
		return $this->array['id'];
	}
	
	public function isSelected() {
		return $this->array['selected'];
	}
	
	public function getDisplayCountry() {
		return $country = '<img src="images/flags/' . strtolower($this->array['country']) . '.png"> ' . Countries::short2long($this->array['country']);
	}
	
	public function getIdentifier() {
		return $userstring = '<b>' . $this->array['userstring'] . '</b>';
	}
	
	public function getIP() {
		return $this->array['ip'];
	}
	
	public function getOperatingSystem() {
		$os = $this->array['os'];
		$osIcon = '<img src="' . OperatingSystem::getIcon($os) . '"> ' . $os;
		return $osIcon;
	}
	
	public function getVersion() {
		$ver = $this->array['version'];
		
		if (strpos($ver, "jRAT") !== false) {
			$verIcon = '<img src="images/icons/icon.png"> ' . $ver;
		} else {
			$verIcon = $ver;
		}
		
		return $verIcon;
	}
	
	public function getPing() {
		$ping = $this->array['ping'];
		
		if ($ping < 50) {
			$icon = 0;
		} else if ($ping < 100) {
			$icon = 1;
		} else if ($ping < 200) {
			$icon = 2;
		} else if ($ping < 400) {
			$icon = 3;
		} else if ($ping < 1000) {
			$icon = 4;
		} else {
			$icon = 5;
		}
		
		return '<img src="images/icons/ping' . $icon . '.png"> ' . $ping . ' ms';
	}
	
	public function getSessionId() {
		return md5(implode(":", $this->array));
	}
	
	public function getOfflineInfo() {
		$array = array(
				$this->array['os'],
				$this->array['userstring'],
				explode(" / ", $this->array['ip'])[0],
		);
		
		return implode(":", $array);
	}
	
	public static function none() {
		$slave = new Slave();
		$s = "Nothing found";
		$slave->makearray($s . ":" . $s . ":" . $s . ":" . $s . ":" . $s . ":" . $s . ":" . $s);
		return $slave;
	}
}