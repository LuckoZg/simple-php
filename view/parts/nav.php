<?php

$pocetnaActive = "";
$unosActive = "";
if($data["active"] == "pocetna")
	$pocetnaActive = "active";
else if($data["active"] == "unos")
	$unosActive = "active";

echo'
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href>Simple PHP Code</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="'.$pocetnaActive.'"><a href="'.BASE_PATH.'">Početna</a></li>
      <li class="'.$unosActive.'"><a href="'.BASE_PATH.'unos">Unos</a></li>
    </ul>
  </div>
</nav>';

?>