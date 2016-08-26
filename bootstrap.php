<?php

function bootstrapApp(){

	$url = (isset($_GET["url"])) ? explode('/', rtrim($_GET["url"], '/')) : NULL;

	$what = ucfirst($url[0]);
	$route = $what.".php";
	$file = "route/".$route;

	if(file_exists($file))
	{
		include($file);
	}
	else if($url[0] == NULL)
	{
		$route = "pregled.php";
		$file = "route/".$route;
		include($file);
	}
	else
	{
		goHome();
	}

}

function goHome(){
	header("Location: ".BASE_PATH);
}

?>