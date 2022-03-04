<?php

// původní hodnoty v $_FORM["mail"] atd...


$rew = rewrite::getRewrite($name, "tbPlaty", $id);

$query = " SET  name = '$name',
		isActive = '$isActive',
		pozice = '$source',
		rok = '$rok',
		plat = '$plat',
		odmeny = '$odmeny',
		pocetmes = '$pocetmes',
		bonus = '$bonus',
		nefbonus = '$nefbonus',
		rew = '$rew'
	 ";

if(empty($id)){
    $id = "-";
}

if ($id == "-"){
    $query = "INSERT INTO tbPlaty $query";
}else{
    $query = "UPDATE tbPlaty $query WHERE id = $id";
}

new sql($query);


mess::create("green", "Plat byl uložen");
$return = true;

$target = $source;
continueTo("labelPlaty");