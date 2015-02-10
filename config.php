<?php

class Config {
	
	public static function loadAuth() {
		$array = parse_ini_file("files/config.ini", true);
		
		$host = $array['auth']['host'];
		$port = $array['auth']['port'];
		$pass = $array['auth']['pass'];
	}
	
}

?>