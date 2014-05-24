<?php
if(empty($database_host)){
	require '../config.php';
}

$db = new PDO("mysql:host=$database_host;dbname=$database_name;charset=utf8", $database_username, $database_password);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
if($development_mode) {
	$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}

