<?php

// původní hodnoty v $_FORM["mail"] atd...


$tempID = $id;


foreach (lang::dejArray() as $lang){
    new sql("delete from tbSEOLang where source = '$tempID' and lang = '{$lang["id"]}'");

    $rew = rewrite::getRewrite(${"langtitle".$lang["id"]});
    new sql("insert into tbSEOLang set text ='".${"langtext".$lang["id"]}."',  source = '$tempID', lang = '{$lang["id"]}'");

}







//echo $query;
mess::create("green", "Data byla uložena");
$return = true;

continueTo("index");







