<?php

// původní hodnoty v $_FORM["mail"] atd...

$rew = rewrite::getRewrite($langtitle1, "tbAkce", $id);

$datum = dateformat($datum, "Y-m-d H:i:s");

$query = " SET  title = '$langtitle1',
		perex = '$langperex1',
		text  ='$langtext1',
		autor = '$autor',
		misto = '$misto',
		photo = '$photo',
		datum = '$datum',
		lat = '$lat',
		lng = '$lng',
		datumDo = '$datumDo',
		isDo = '$isDo'
	 ";
	
if ($id == "-"){
    $query = "INSERT INTO tbAkce $query";

    $temp = new sql($query);
    $tempID = $temp->inserted();

    $query = "UPDATE tbAkcePhotos set source = '$tempID' WHERE source = 0";
    new sql($query);
}else{
    $query = "UPDATE tbAkce $query WHERE id = $id";
    $temp = new sql($query);
    $tempID = $id;
}

//echo $query;


$rew = rewrite::getRewrite($langtitle."-".dateformat($datum, "Y-m-d"));
$query = "UPDATE tbAkce set rew = '$rew' WHERE id = $tempID";
new sql($query);


foreach (lang::dejArray() as $lang){
    new sql("delete from tbAkceLang where source = '$tempID' and lang = '{$lang["id"]}'");


    $rew = rewrite::getRewrite(${"langtitle".$lang["id"]});
    new sql("insert into tbAkceLang set title='".${"langtitle".$lang["id"]}."', text ='".${"langtext".$lang["id"]}."', rew = '$rew', perex ='".${"langperex".$lang["id"]}."',  source = '$tempID', lang = '{$lang["id"]}'");

}


//echo $query;
mess::create("green", "Data o akci byla uložena");
$return = true;

continueTo("index");







