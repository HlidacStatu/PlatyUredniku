<?php


// původní hodnoty v $_FORM["mail"] atd...

$mail = trim(strtolower($mail));
	
if ($id == "-"){




    $pass = user::hashPass($pass);


    $query = "INSERT INTO tbUsers SET mail = '$mail', 
                                      login='$login', 
                                      pass='$pass', 
                                      name='$name',
                                      photo='$photo',
                                      telefon1 = '$telefon1',
                                      telefon2 = '$telefon2',
                                      adresa = '$adresa',
                                      ico = '$ico',
                                      dic = '$dic',
                                      type = '$type',
                                      last=NOW(),
                                      created=NOW(),
                                      ip='".dejIP()."',
                                      isAdmin='$isAdmin', 
                                      isActive='$isActive', 
                                      isDel=0";


   $tmp =  new sql($query);
    $id = $tmp->inserted();
}else{
    $tmp = "";
    if(!empty($pass)){
        $pass = user::hashPass($pass);
        $tmp = "pass='$pass', ";
    }

    $query = "UPDATE tbUsers SET mail = '$mail', 
                                      name='$name',
                                      $tmp
                                      photo='$photo',
                                      telefon1 = '$telefon1',
                                      telefon2 = '$telefon2',
                                      adresa = '$adresa',
                                      ico = '$ico',
                                      dic = '$dic',
                                      type = '$type',
                                      isAdmin='$isAdmin', 
                                      isActive='$isActive',  
                                      isDel=0
                   WHERE id = $id";

    new sql($query);
}


new sql("delete from tbUsersOwners where owner = '$id'");
$tmp = explode(";",$owned);
foreach ($tmp as $val){
        new sql("insert into tbUsersOwners set owner = '$id', objekt= '$val'");
}

new alert("green", "Uživatelská data byla uložena");

continueTo("index");