<?php

// původní hodnoty v $_FORM["mail"] atd...

new sql("DELETE FROM tbFormulareSet where lang = '$lang'");

$query = " SET 
		lang = '$lang',
		mail = '$mail'
	 ";
	
 
    $query = "INSERT INTO tbFormulareSet $query";

//echo $query;

new sql($query);


mess::create("green", "Správa formulářů byla uložena");
$return = true;

$target = $lang;

continueTo("index");