<?php

include('model/film.php');

$data = array();

if(isset($url[1]) && $url[1] == "delete" && isset($url[2]))
{
	$id = (int)$url[2];

	$response = delete($id);

	if($response["status"])
		header("Location: ".BASE_PATH."unos/deleted");

	$data["response"] = $response;
}

if(isset($url[1]) && $url[1] == "deleted")
{
	$data["response"] = array("status" => 1, "msg" => "Film je uspješno obrisan");
}

if(isset($url[1]) && $url[1] == "posted")
{
	$data["response"] = array("status" => 1, "msg" => "Film je uspješno unesen");
}

if(isset($_POST["btnSubmit"]))
{
	$response = post($_POST, $_FILES);

	if($response["status"])
		header("Location: ".BASE_PATH."unos/posted");

	$data["response"] = $response;
}

$data["zanrovi"] = get_zanrovi();
$data["filmovi"] = get("");
$data["active"] = "unos";

include("view/unos.html");

?>