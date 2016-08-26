<?php

function get($slovo){
	$data = array();

	global $db;

	$query = "SELECT *
			  FROM filmovi
			  WHERE naslov LIKE :slovo
			  ORDER BY naslov ASC";

	try {
		$stmt = $db->prepare($query);
		$stmt->execute(array(':slovo' => $slovo.'%'));

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			array_push($data, $row);
		}
	}
	catch(PDOException $ex){
		$ex->getMessage();
	}

	return $data;
}

function get_zanrovi(){
	$data = array();

	global $db;

	$query = "SELECT id, naziv
		  	  FROM zanr
		      ORDER BY naziv ASC";

    try {
    	$stmt = $db->query($query);
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			array_push($data, $row);
		}
	}
	catch(PDOException $ex){
		$ex->getMessage();
	}

	return $data;
}

function delete($id){
	$data = array("status" => 0, "msg" => "No change");

	global $db;

	$query = "SELECT slika FROM filmovi
			  WHERE id = :id";

	try {
		$stmt = $db->prepare($query);
		$stmt->execute(array(':id' => $id));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	}
	catch(PDOException $ex){
		$ex->getMessage();
	}

	if(is_file(IMAGES_REL_PATH.$row["slika"]))
	{
		unlink(IMAGES_REL_PATH.$row["slika"]);

		$query = "DELETE FROM filmovi
				  WHERE id = :id";

		try {
			$stmt = $db->prepare($query);
			$stmt->execute(array(':id' => $id));
		}
		catch(PDOException $ex){
			$ex->getMessage();
		}
		
		return array("status" => 1, "msg" => "Film je obrisan");
	}

	return array("status" => 1, "msg" => "Film je obrisan");
}

function post($post, $files)
{
	$data = array("status" => 0, "msg" => "No change");

	global $db;

	if($post["naslov"] == "" ||
	   $post["zanr"] == "" ||
	   $post["godina"] == "" ||
	   $post["trajanje"] == "" ||
	   $files["img"]["tmp_name"] == "")
	{
		$data = array("status" => 0, "msg" => "Sva polja su obavezna");
	}
	else
	{
		$naslov = $post["naslov"];
		$id_naziv = $post["zanr"];
		$godina = $post["godina"];
		$trajanje = $post["trajanje"];

		$name     = $files["img"]["name"];
		$tmp_name = $files["img"]["tmp_name"];
		$error    = $files["img"]["error"];

		if($error == 0)
		{
			$file_name_array = explode(".", $name);
			$ext = end($file_name_array);
			$new_name = "doc_".time().".".$ext;
			$path = IMAGES_REL_PATH.$new_name;

			if(move_uploaded_file($tmp_name, $path))
			{	
				$query = "INSERT INTO filmovi
						   		(naslov, id_naziv, godina, trajanje, slika)
								VALUES
						   		(:naslov, :id_naziv, :godina, :trajanje, :new_name)";

				try {
					$stmt = $db->prepare($query);
					$stmt->execute(array(':naslov' => $naslov, ':id_naziv' => $id_naziv, ':godina' => $godina, ':trajanje' => $trajanje, ':new_name' => $new_name));
				}
				catch(PDOException $ex){
					unlink($path);
					//$data = array("status" => 0, "msg" => "Greška pri unosu u bazu");
					$ex->getMessage();
				}

				$data = array("status" => 1, "msg" => "Film je uspješno unesen");
			}
			else
			{
				$data = array("status" => 0, "msg" => "Greška pri upload-u");
			}
		}
		else 
		{
			$data = array("status" => 0, "msg" => "Greška u file-u");
		}
	}

	return $data;
}



?>