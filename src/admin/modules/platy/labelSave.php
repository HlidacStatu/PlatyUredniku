<?php

// původní hodnoty v $_FORM["mail"] atd...


$rew = rewrite::getRewrite($name, "tbPlaty", $id);

$query = " SET  name = '$name',
		isActive = '$isActive',
		pozice = '$pozice',
		rok = '$rok',
		plat = '$plat',
		odmeny = '$odmeny',
		pocetmes = '$pocetmes',
		bonus = '$bonus',
		nefbonus = '$nefbonus',
		rew = '$rew'
	 ";
	
if ($id == "-"){
    $query = "INSERT INTO tbPlaty $query";
}else{
    $query = "UPDATE tbPlaty $query WHERE id = $id";
}

mysqli_query($link, $query);


mess::create("green", "Instituce byla uložena");
$return = true;

continueTo("index");