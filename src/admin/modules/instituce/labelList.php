<?php

    if ($_POST["type"] == "all"){$query = " and isDel = 0 "; }
    if ($_POST["type"] == "non"){$query = "and isDel = 0 and isActive = 0 ";}
    if ($_POST["type"] == "active"){$query = "and isDel = 0 and isActive = 1 ";}
    if ($_POST["type"] == "home"){$query = "and isDel = 0 and onHome = 1 ";}
    
    if ($_POST["type"] == "search"){
	$query = "and isDel = 0 and name LIKE  '%$search%'"; }



if ($_POST["type"] == "byfiltr"){

    $query = "and isDel = 0 and druh = $filter ";
}

$out = instituce::dejList($pageNum, $query);



if ($out == "" ){
ob_clean();
echo "[[END]]";die;
    }else{
        $photoOrder = new sortableSpace("files", "setOrder", $multifiles);


        echo $out;

        $photoOrder->plotThere();
    }
	    die;