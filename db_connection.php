<?php

$server   = 'localhost';
$username = 'root';
$password = '';
$database = 'kolekcija';

$db = mysql_connect($server, $username, $password);

if($db)
{
	#echo 'Uspjesno spojeni na MySQL server';
	
	if(mysql_select_db($database, $db))
	{
		#echo '<br />Baza podataka uspjesno odabrana';
		mysql_query("SET NAMES utf8");
	}
	else
	{
		echo 'Pogreska kod odabira baze';
	}
}
else
{
	echo 'Pogreska kod spajanja na MySQL server';
}

?>