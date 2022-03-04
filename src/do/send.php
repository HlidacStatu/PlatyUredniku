<?php


ignore_user_abort();

if($_POST["secure"] != $_SESSION["secure"]){
    die("doslo k chybe, zkontrolujte prosim zapnuti js.");
}

/*
var_dump($_SESSION);
var_dump($_POST);
die;*/

if(isset($_POST["E-mail"])){
    $_SESSION["E-mail"] = strip_tags($_POST["E-mail"]);
}

$not = array("url", "source", "hotel", "secure");

$data = "";


foreach ($_POST as $key => $val){

    if(!in_array($key, $not)) {


        $_POST[$key] = valid($val);

        $key = str_replace("_", " ", $key);
        $data .= "<p><strong>$key:</strong> $val</p>";
    }
}



if(isset($_POST["E-mail"]) && empty($_POST["E-mail"]) ){
    die;
}



$text = "<h1>Kontaktní formulář:</h1>
<br>
<strong>Stránka: </strong> <a href='{$_SESSION["lastUrl"]}'>{$_SESSION["lastUrl"]}</a>
<br>
<br>
<strong>Údaje z formuláře:</strong><br>

    $data


";

echo $text;


 //fly("kolardario@gmail.com", "Kontaktní formulář z platytopuredniku.cz", $text);
fly("info@platytopuredniku.cz", "Kontaktní formulář z platytopuredniku.cz", $text);


$text = sql::real_escape_string($text);

$query = "insert into tbFormulare set mail = '{$_POST["E-mail"]}', source = '{$_POST["source"]}',  url = '{$_POST["hotel"]}', date = NOW(), data = '$data';";
//echo_array($query);
new sql($query);

$_SESSION["senddekujeme"] = true;

header("Location: ".$_SESSION["lastUrl"]."#send");