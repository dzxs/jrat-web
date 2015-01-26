<?php

require_once "slave.php";

class Request {
	
	public function createSocket($address = "127.0.0.1", $port = "1335", $password = "PWD") {
		$sock = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
		
		socket_connect($sock, $address, $port) or die("Could not connect to host\n");
				
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
	
	public function disconnect($sock) {
		self::write($sock, -1);
		socket_close($sock);
	}
	
	private function write($sock, $s) {
		socket_write($sock, $s . "\n", strlen($s) + 1) or die("Failed to write to socket\n");
	}
}