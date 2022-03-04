<?php



$page = strip_tags($_GET["p"]);
$rew = strip_tags($_GET["rew"]);
$cat = strip_tags($_GET["cat"]);
$det = strip_tags($_GET["det"]);





session_start();
if (isset($_GET["clear"])){
    session_destroy();
    session_start();
    session_regenerate_id(true);
}

require_once dirname(__FILE__) . "/admin/core/load.php";


if (!isset($_SESSION["loged"]) or ($_SESSION["loged"] != true)) {
}else{
$user = user::dejData($_SESSION["id"]);
}

//----------------------




//----------------------

if($page == "import"){
    $page = str_replace(".php", "", $rew);
    require_once dirname(__FILE__) . "/import/sql2.php";
    if (file_exists(dirname(__FILE__) . "/import/$rew.php")) {
        require_once dirname(__FILE__) . "/import/$rew.php";
    } else {
        echo "Cron nenalezen!"; fly("kolardario@gmail.com","Harrachov Cron", "Cron /cron/$rew.php nebyl nalezen a spuštěn! <br> ".dateformat("now", "j.n.Y H:m"));
    }
    die;
}


if($page == "cron"){
    $page = str_replace(".php", "", $rew);
    if (file_exists(dirname(__FILE__) . "/cron/$rew.php")) {
        require_once dirname(__FILE__) . "/cron/$rew.php";
    } else {
       echo "Cron nenalezen!"; fly("kolardario@gmail.com","Harrachov Cron", "Cron /cron/$rew.php nebyl nalezen a spuštěn! <br> ".dateformat("now", "j.n.Y H:m"));
    }
    die;
}


if($page == "do"){
    $page = str_replace(".php", "", $rew);


    if (file_exists(dirname(__FILE__) . "/do/$rew.php")) {
    require_once dirname(__FILE__) . "/do/$rew.php";
    } else {
       require_once dirname(__FILE__) . "/404.php";
    }
    die;
}

if($page == "ajax"){
    $page = str_replace(".php", "", $rew);
    if (file_exists(dirname(__FILE__) . "/ajax/$rew.php")) {
        require_once dirname(__FILE__) . "/ajax/$rew.php";
    } else {
        require_once dirname(__FILE__) . "/404.php";
    }
    die;
}

$_SESSION["lastUrl"] = $_SERVER['REQUEST_URI'];







$pageformenu = $page;


if($page == "page"){
    $pageformenu = $rew;
    $page = $rew;
    $rew = $cat;
}


if ($page == "") {
   require_once dirname(__FILE__) . "/homepage.php";
} else {
    if (file_exists(dirname(__FILE__) . "/$page.php")) {
	    require_once dirname(__FILE__) . "/$page.php";
    } else {
	unset($data);






        $institucedruh = institucedruh::dejByRew($page);
        if (!empty($institucedruh["id"])) {

            $pageformenu = "instutuce";

            require_once dirname(__FILE__) . "/druhyinstituci.php";
            die;
        }



        $temp = $page;
        $page = new pageout();
        $page->byrew($temp);
        $rew = $temp;

        if (!empty($page->id)){
            require_once dirname(__FILE__) . "/page.php";
        }else{

                require_once dirname(__FILE__) . "/404.php";
            }


    }
}

