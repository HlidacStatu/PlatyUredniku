<?php



$_SESSION["lang"] = intval($_GET["lang"]);

$query = "SELECT * FROM tbLangs where id = '{$_SESSION["lang"]}' and isActive = 1 and isDel = 0 ";
$data = new sql($query);
foreach ($data->all() as $zaznam){

    $_SESSION["lang"] = $zaznam["id"];
    $_SESSION["langName"] = strtolower($zaznam["short"]);



}

$url = $_SESSION["lastUrl"];

$query = "SELECT * FROM tbLangs where isActive = 1 and isDel = 0 ";
$data = new sql($query);
foreach ($data->all() as $zaznam){

    if(substr($url, 0, 3) == "/".strtolower($zaznam["short"])){
        $url = substr($url, 3);
    }

 //   $url = str_replace("/".strtolower($zaznam["short"]), "", $url);



}

if($_SESSION["lang"] != 1){
    $url = "/".$_SESSION["langName"].$url;
}


header("Location: /");
//header("Location: {$url}");


