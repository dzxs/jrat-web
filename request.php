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
		
		$slaves = explode(";", $raw);
		
		foreach ($slaves as $slave) {
			$s = new Slave();
			$s->set($slave);
			echo $slave . "\n";
		}
	}
	
	private function write($sock, $s) {
		socket_write($sock, $s . "\n", strlen($s) + 1) or die("Failed to write to socket\n");
	}
}

class Slave {
	
	public function set($s) {
		$data = explode(":", $s);
	}
}