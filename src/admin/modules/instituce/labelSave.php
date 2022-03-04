<?php

// původní hodnoty v $_FORM["mail"] atd...



$rew = rewrite::getRewrite($name, "tbInstituce", $id);

$query = " SET  name = '$name',
		isActive = '$isActive',
		perex = '$perex',
		druh = '$druh',
		note = '$note',
		contacts = '$contacts',
		status = '$status',
		statusNote = '$statusNote',
		photo = '$photo',
		rew = '$rew'
	 ";
	
if ($id == "-"){
    $query = "INSERT INTO tbInstituce $query";
}else{
    $query = "UPDATE tbInstituce $query WHERE id = $id";
}

mysqli_query($link, $query);


mess::create("green", "Instituce byla uložena");
$return = true;

continueTo("index");