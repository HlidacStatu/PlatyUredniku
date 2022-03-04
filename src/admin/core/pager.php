<?php

require_once dirname(__FILE__).'/load.php';


if (isset($_SESSION["loged"]) and ($_SESSION["loged"] == true)){
    $user = user::dejData($_SESSION["id"]);
    $_SESSION["client"] = $user["client"];
}else{
    require  dirname(__FILE__) . '/../login.php';
    die;
}

if (isset($_POST["form"])){
if (is_array($_POST["form"]) == true) {
            while (list( $key, $val ) = each($_POST["form"])) {
		$val["name"]  = valid($val["name"] );
		$_FORM["{$val["name"]}"] = $val["value"];
		$val["value"]  = valid($val["value"] );

		//echo $val["name"]." -> ".$val["value"]."<br>";

                ${$val["name"]} = $val["value"];

            }
        }
	unset($_POST["form"]);
}

if(isset($_POST["editornames"])) {
    $temp = 0;
    foreach ($_POST["editornames"] as $names) {
        ${$names[0]} = sql::real_escape_string($_POST["editors"][$temp][0]);
        $temp++;
    }
    unset($temp);
}


global $_FORM;

if (is_array($_POST) == true) {
            while (list( $key, $val ) = each($_POST)) {
		$val  = valid($val);
                $$key = $val;
            }
        }
	
if ($tabControlSet){
    $_SESSION["tabControlLast"]["$module"] = str_replace("TAB", "", $tabSet);
    die;
}

if ($labelControlSet){
    $_SESSION["labelControlLast"]["$module"] = str_replace("LABEL", "", $labelSet);
    $_SESSION["labelControlLastSearch"]["$module"] = str_replace("LABEL", "", $searchSet);
    $_SESSION["labelControlLastFilter"]["$module"] = str_replace("LABEL", "", $searchFilter);
    die;
}

$id = $target;

$module = valid($_POST["module"]);
$page = valid($_POST["page"]);

alert::show();


$allowedmodules = array("home", "objekt", "lastminute", "formulare", "balicky", "moje");
if(!usertype("admin") && !in_array($module, $allowedmodules)){
    new alert("red", "Nemáte oprávnění k tété akci");
    alert::show();
    die;
}




if (file_exists(dirname(__FILE__).'/../modules/'.$module.'/'.$page.'.php') ){
   require_once dirname(__FILE__).'/../modules/'.$module.'/'.$page.'.php';
}else{
   require_once dirname(__FILE__).'/../modules/'.$module.'/index.php';
}
