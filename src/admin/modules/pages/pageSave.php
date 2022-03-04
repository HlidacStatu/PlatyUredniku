<?php

// původní hodnoty v $_FORM["mail"] atd...



$rew = rewrite::getRewrite($title, "tbPages", $id);



$query = " SET  title = '$title',
		isActive = '$isActive',
		photo = '$photo',
		rew = '$rew',
		text = '$text'
	 ";

//echo $query;
	
if ($id == "-"){
    $query = "INSERT INTO tbPages $query";

    $tmp = new sql($query);
    $tempID = $tmp->inserted();




}else{
    $query = "UPDATE tbPages $query WHERE id = $id";
    new sql($query);
    $tempID= $id;
}

//echo $query;



mess::create("green", "Data o stránce byla uložena");
$return = true;

continueTo("index");