<?php

include("model/film.php");

$data = array();

$data["abeceda"] = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','r','s','t','u','v','z');

$slovo = "";
if(isset($url[1]))
{
	$slovo = $url[1];
	if(!in_array($slovo, $data["abeceda"])){
		goHome();
	}
}

$data["filmovi"] = get($slovo);
$data["active"] = "pocetna";

include("view/pregled.html");

?>