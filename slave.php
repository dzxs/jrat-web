<?php

require_once "operatingsystem.php";
require_once "countries.php";

class Slave {

	public $array;

	public function makearray($s) {
		$data = explode(":", $s);
		$this->array = array(
				"strid" => $data[0],
				"id" => $data[1],
				"selected" => $data[2],
				"country" => $data[3],
				"userstring" => $data[4],
				"os" => $data[5],
				"ip" => $data[6],
				"version" => $data[7],
				"ping" => $data[8],
		);
	}
	
 	public function getStringId() {
 		return $this->array['strid'];
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
		if ($this->isOffline()) {
			return '<button type="submit" name="command" class="btn btn-danger btn-xs"> Offline';
		} else {
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
	}
	
	public function getSessionId() {
		return md5(implode(":", $this->array));
	}
	
	public function isOffline() {
		return $this->array['id'] == "0";
	}
	
	public static function none() {
		$slave = new Slave();
		$s = "Nothing found";
		$slave->makearray($s . ":" . $s . ":" . $s . ":" . $s . ":" . $s . ":" . $s . ":" . $s);
		return $slave;
	}
}