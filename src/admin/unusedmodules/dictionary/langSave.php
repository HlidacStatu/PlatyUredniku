<?php

// původní hodnoty v $_FORM["mail"] atd...

$query = " SET name = '$name', 
               icon ='$icon', 
               short ='$short',
               isActive=$isActive
	 ";

if ($id == "-"){
    $query = "INSERT INTO tbLangs $query";
    $tmp = new sql($query);
    $id = $tmp->inserted();
    file_put_contents( dirname(__FILE__) ."/$id.txt" , "blank");
     
}else{
    $query = "UPDATE tbLangs $query WHERE id = $id";
    new sql($query);
}

$_FORM["file"] = $_FORM["file"]." ";

$filename = dirname(__FILE__)."/$id.txt";
$handle = fopen($filename, "w");
fwrite($handle,$_FORM["file"]);
fclose($handle);

mess::create("green", "Data o jazykové mutaci byla uložena");
$return = true;

continueTo("index");