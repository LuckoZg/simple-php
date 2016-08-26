<?php

$type = NULL;
if($data["response"]["status"] === 0)
	$type = "danger";
else if($data["response"]["status"] === 1)
	$type = "success";

if($type)
{
	echo'
	<div class="alert alert-'.$type.'">
  		'.$data["response"]["msg"].'
	</div>
	';
}

?>