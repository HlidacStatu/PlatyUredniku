<?php

    if ($_POST["type"] == "all"){$query = " and isDel = 0 "; }
    if ($_POST["type"] == "admin"){$query = "and isDel = 0 and isAdmin = 1 and type= 'admin' ";}
    if ($_POST["type"] == "owner"){$query = "and isDel = 0 and isAdmin = 1 and type= 'owner' ";}

    if ($_POST["type"] == "search"){
	$query = "and isDel = 0 and name LIKE  '%$search%'"; }
    $out = user::dejList($pageNum, $query);
    
   
    if ($out == "" ){
ob_clean();
echo "[[END]]";die;
    }else{
	echo $out;
    }
	    die;