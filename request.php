<?php

class Request {
	
	public function connect($address = "127.0.0.1", $port = "1335", $password = "PWD") {
		$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		$connection = socket_connect($sock, $address, $port);
		
		if ($connection === FALSE) {
			die("Failed to connect: " . socket_strerror(socket_last_error($sock)));
		}
		
		socket_write($sock, chr(0));
		$pwd = strlen($password) . $password . "\n";
		socket_write($sock, $pwd, strlen($pwd));
		
		return $sock;
	}
	
	public function getConnected() {
		socket_write($sock, chr(1));
		$len = socket_read($sock, PHP_NORMAL_READ);
		echo $len;
	}
}