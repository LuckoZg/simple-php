<?php

$server   = 'localhost';
$username = 'root';
$password = '';
$database = 'kolekcija';

try {
    $db = new PDO('mysql:host='.$server.';dbname='.$database.';charset=utf8', $username, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch(PDOException $ex) {
    echo $ex->getMessage();
}


?>