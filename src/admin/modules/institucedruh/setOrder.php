<?php

$i = 1;

$sort = str_replace("item[]=", "", $_POST["sort"]);

$sort = explode("&", $sort);

foreach ($sort as $value) {
    $query = " UPDATE tbInstituceDruh SET  ownOrder =  '$i' WHERE id = $value ";
    
    new sql($query);
    
    $i++;
}

echo "ORDER SAVED";