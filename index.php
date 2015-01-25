<?php
xdebug_disable();

require_once "request.php";

$action = $_GET['action'];

if (isset($action)) {
	
} else {
	$request = new Request();
	$sock = $request->createSocket();
	$request->getSlaves($sock);	
}