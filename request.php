<?php

require_once "slave.php";

class Request {
	
	public function createSocket($address = "127.0.0.1", $port = "1335", $password = "PWD") {
		$sock = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
		
		socket_connect($sock, $address, $port);
		$error = socket_strerror(socket_last_error($sock));
		if (strpos($error, "successfully") === false) {
			return " Error: " . $error;
		}
				
		$this->write($sock, sha1($password));		
		
		return $sock;
	}
	
	public function getSlaves($sock) {
		$this->write($sock, 1);
		$raw = socket_read($sock, 1024 * 10, PHP_NORMAL_READ) or die("Could not read from socket\n");
		
		$slaveStrings = explode(";", $raw);
		$slaves = array();
		
		foreach ($slaveStrings as $string) {
			if (strlen($string) <= 1) {
				continue;
			}

			$s = new Slave();
			$s->makearray($string);
			array_push($slaves, $s);
		}
		
		return $slaves;
	}
	
	public function getCountryStats($sock) {
		$this->write($sock, 12);
		$raw = socket_read($sock, 1024 * 10, PHP_NORMAL_READ) or die("Could not read from socket\n");
		
		$rawStrings = explode(";", $raw);
		$countries = array();
		
		foreach ($rawStrings as $string) {
			if (strlen($string) <= 1) {
				continue;
			}
		
			$split = explode(",", $string);
			$countries[$split[0]] = $split[1];
		}
		
		return $countries;
	}
	
	public function getOperatingSystemStats($sock) {
		$this->write($sock, 13);
		$raw = socket_read($sock, 1024 * 10, PHP_NORMAL_READ) or die("Could not read from socket\n");
	
		$rawStrings = explode(";", $raw);
		$os = array();
	
		foreach ($rawStrings as $string) {
			if (strlen($string) <= 1) {
				continue;
			}
	
			$split = explode(",", $string);
			$os[$split[0]] = $split[1];
		}
	
		return $os;
	}

	
	public function disconnect($sock) {
		self::write($sock, -1);
		socket_close($sock);
	}
	
	public function write($sock, $s) {
		socket_write($sock, $s . "\n", strlen($s) + 1) or die("Failed to write to socket\n");
	}
	
 	public function isError($sock) {
 		return strpos($sock, "Error") == 1;
 	}
}