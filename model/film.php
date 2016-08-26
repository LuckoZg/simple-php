<?php

function get($slovo){
	$data = array();

	$query = "SELECT *
			  FROM filmovi
			  WHERE naslov LIKE '$slovo%'
			  ORDER BY naslov ASC";

	$result = mysql_query($query) or die(mysql_error());

	while($row = mysql_fetch_array($result)){
		array_push($data, $row);
	}

	return $data;
}

function get_zanrovi(){
	$data = array();

	$query = "SELECT id, naziv
		  	  FROM zanr
		      ORDER BY naziv ASC";

	$result = mysql_query($query) or die(mysql_error());

	while($row = mysql_fetch_array($result)){
		array_push($data, $row);
	}

	return $data;
}

function delete($id){
	$data = array("status" => 0, "msg" => "No change");

	$query = "SELECT * FROM filmovi
			  WHERE id = '$id'";

	$result = mysql_query($query) or die(mysql_error());

	$row = mysql_fetch_array($result);

	if(is_file(IMAGES_REL_PATH.$row["slika"]))
	{
		unlink(IMAGES_REL_PATH.$row["slika"];
			
		$query = "DELETE FROM filmovi
				  WHERE id = '$id'";

		$result = mysql_query($query) or die(mysql_error());
		
		return array("status" => 1, "msg" => "Film je obrisan");
	}

	return array("status" => 0, "msg" => "Film je obrisan");
}

function post($post, $files)
{
	$data = array("status" => 0, "msg" => "No change");

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
				$queryInsert = "INSERT INTO filmovi
						   		(naslov, id_naziv, godina, trajanje, slika)
								VALUES
						   		('$naslov', '$id_naziv', '$godina', '$trajanje', '$new_name')";
						   
				if($queryResult = mysql_query($queryInsert))
				{
					$data = array("status" => 1, "msg" => "Film je uspješno unesen");
				}
				else
				{
					unlink($path);
					$data = array("status" => 0, "msg" => "Greška pri unosu u bazu");
				}
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