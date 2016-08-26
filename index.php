<?php

error_reporting(0); //E_ALL & ~E_NOTICE);

define("BASE_PATH", "http://localhost/tecaj/seminarski_obj/");
define("IMAGES_PATH", BASE_PATH."public/images/");
define("IMAGES_REL_PATH", "public/images/");

include("db_connection.php");
include("bootstrap.php");

bootstrapApp();

?>