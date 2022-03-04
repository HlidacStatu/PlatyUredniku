<?php

    if ($_POST["type"] == "all"){$query = " and isDel = 0 "; }
    if ($_POST["type"] == "non"){$query = "and isDel = 0 and isActive = 0 ";}
    if ($_POST["type"] == "active"){$query = "and isDel = 0 and isActive = 1 ";}
    if ($_POST["type"] == "home"){$query = "and isDel = 0 and onHome = 1 ";}
    
    if ($_POST["type"] == "search"){
	$query = "and isDel = 0 and data LIKE  '%$search%'"; }



if(usertype("owner")){
    $query .= " and source in (".user::dejOwned4select($_SESSION["id"]).")";
}



$out = formulare::dejList($pageNum, $query);
    
   
    if ($out == "" ){
ob_clean();
echo "[[END]]";die;
    }else{
	echo $out;
    }
	    die;