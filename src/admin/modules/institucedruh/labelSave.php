<?php

// původní hodnoty v $_FORM["mail"] atd...



$rew = rewrite::getRewrite($name, "tbInstituceDruh", $id);

$query = " SET  name = '$name',
		isActive = '$isActive',
		photo = '$photo',
		rew = '$rew'
	 ";
	
if ($id == "-"){
    $query = "INSERT INTO tbInstituceDruh $query";
    $tmp = new sql($query);

    $idcko = $tmp->inserted();
}else{
    $query = "UPDATE tbInstituceDruh $query WHERE id = $id";
    $tmp = new sql($query);

    $idcko = $id;
}




mess::create("green", "Druh instituce byl uložen");
$return = true;

continueTo("index");