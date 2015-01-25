<?php

class Request {
		
	public function createSocket($address = "127.0.0.1", $port = "1335", $password = "PWD") {
		$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		$connection = socket_connect($sock, $address, $port);
		
		if ($connection === FALSE) {
			die("Failed to connect: " . socket_strerror(socket_last_error($sock)));
		}
		
		socket_write($sock, chr(0));
		$pwd = sha1($password) . "\n";
		socket_write($sock, $pwd);
		
		socket_write($sock, chr(-1));
		return $sock;
	}
}