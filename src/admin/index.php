<?php


if(isset($_GET["reload"])){
  $mainLoad = true;  
}
require_once dirname(__FILE__).'/core/load.php';


if (isset($_SESSION["loged"]) and ($_SESSION["loged"] == true)){
    $user = user::dejData($_SESSION["id"]);
    $_SESSION["client"] = $user["client"];
}else{
    require  dirname(__FILE__) . '/login.php';
    die;
}

?>
<!DOCTYPE HTML>
<html>
    <head>
	    <meta http-equiv="content-type" content="text/html; charset=utf-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge" >
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">



        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700&subset=latin-ext' rel='stylesheet' type='text/css'>
        <script type='text/javascript' src='https://code.jquery.com/jquery-latest.min.js'></script>


        <meta name="theme-color" content="white">

        <link rel="stylesheet" href="/admin/style/template.css" type="text/css">
        <link rel="stylesheet" href="/admin/style/analytics.css" type="text/css">
        <link rel="stylesheet" href="/admin/style/ckown.css" type="text/css">


        <link rel="shortcut icon" href="/img/icons/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="/img/icons/android-icon-192x192.png" type="image/png">
        <link rel="apple-touch-icon" sizes="57x57" href="/img/icons/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/img/icons/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/img/icons/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/img/icons/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/img/icons/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/img/icons/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/img/icons/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/img/icons/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/img/icons/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/img/icons/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/img/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/img/icons/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/img/icons/favicon-16x16.png">
        <link rel="manifest" href="/img/icons/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/img/icons/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

	    <title><?php echo $rocket["name"]; ?></title>

	    <link href="/admin/style/font-awesome.min.css" rel="stylesheet" type="text/css">
	
        <link rel="stylesheet" href="/admin/scripts/jquery-ui.css">
        <script src="/admin/scripts/jquery-ui.js"></script>

        <script src="/admin/scripts/datepicker-cs.js"></script>


        <script src="/admin/ckeditor/ckeditor.js"></script>

	    <script type='text/javascript' src='/admin/scripts/mainControler.js'></script>
	    <script type='text/javascript' src='/admin/scripts/btnControler.js'></script>
	    <script type='text/javascript' src='/admin/scripts/main-menu.js'></script>

	    <script type='text/javascript' src='/admin/scripts/uploader.js'></script>
	    <script type='text/javascript' src='/admin/scripts/editor.js'></script>
	    <script>      var valid = 0;  </script>
    </head>
<body>
    <div class="top">
	<div class="logo">
	    <a href="/" ><img src="<?php echo $rocket["adminLogo"]; ?>" style=" height: 40px;   margin: 30px 0 0 20px;"></a>
    </div>
            <div class="userMin">
                <div class="userPhoto a" style="background-image: url(<?php echo photo($user["photo"], "small", "img/user.png"); ?>)" ></div>
                <div class="userName a"><?php echo $user["name"]; ?></div>
                <div class="user a">
                    <div class="userPhoto a" style="background-image: url(<?php echo photo($user["photo"], "small", "img/user.png"); ?>)" ></div>
                    <div class="userName a"><?php echo $user["name"];echo " &nbsp;"; echo user::userTypeLabel($user["type"]);  ?></div>
                    <div class="userMail a"><?php echo $user["mail"]; ?></div> 
                    <div class="btns">
                       <div class="mainBtn a" module="moje" data=""><i class="fa fa-user"></i> M??j ????et</div>
                       <a href="modules/users/logout.php"><div class="mainBtn a" page="logout" data=""><i class="fa fa-sign-out"></i> Odhl????en??</div></a>
                    </div>
                </div>
            </div>
    </div>


    <div class="container">
	<div class="left">
	    <div class="mainMenu">
		<?php    $menu->plot();  ?>
	    </div>
	    
	    <div class="sideMenu">
		<?php    $menu->plotBottom();  ?>
	    </div>
	</div>
	<div class="content a">
        <div class="in">

            <script>
                <?php
$_GET["module"] = valid($_GET["module"]);
$_GET["page"] = valid($_GET["page"]);
                if(empty($_GET["module"])){
                    $_GET["module"] = "home";
                    $_GET["page"] = "index";
                }
                if(empty($_GET["page"])){
                    $_GET["page"] = "index";
                }


                ?>

                module = "<?=valid($_GET["module"]); ?>";
                rootName = "<?=$rocket["name"]; ?>";

                $(".mainBtn").each(function(){
                    if ($(this).attr("module") === module){
                        $(this).addClass("active");
                        document.title = rootName+" - "+$(this).html().replace(/<(?:.|\n)*?>/gm, '');
                    }
                });

                $.ajax({type: "POST",
                    url: "/admin/core/pager.php",
                    data: { module: "<?=valid($_GET["module"]); ?>", page: "<?=valid($_GET["page"]); ?>", target: "<?=valid($_GET["target"]); ?>", source: "<?=valid($_GET["source"]); ?>"}
                }).done(function( data ) {
                    buildAdminUrl("<?=valid($_GET["module"]); ?>", "<?=valid($_GET["page"]); ?>", "<?=valid($_GET["target"]); ?>", "<?=valid($_GET["source"]); ?>");
                    $(".content .in").delay(400).queue( function(next){
                        $(this).html(data);
                        $(".content .in").fadeTo(400,1);
                        $(".content").removeClass("loading");
                        next();
                    });

                });


            </script>
        </div>
	</div>
	<div class="clear"></div>
    </div>
	    
    <div class="cover coverFile">
        <div class="oknoFile">
            <div class="close a"><i class="fa fa-times"></i></div>
            <h2><i class="fa fa-folder-open"></i> Spr??vce soubor??</h2>
            <div class="in">
            </div>
        </div>
    </div>
	    
    <div class="cover coverAccept">
        <div class="oknoAccept">
            <div class="in">   
            </div>
        </div>
    </div>
	    
    <div class="cover float">
        <div class="oknoNote">
            <div class="in">  
            </div>
        </div>
    </div>
	    

	    
    <div class="bottom">
		?? 2014 <?php if (date("Y", (strtotime("now"))) != "2014"){ echo " - ".date("Y", (strtotime("now")));};?> 
		&nbsp; | &nbsp;  
		Release <?php echo $rocket["version"]; ?>
		<?php echo $rocket["bottom"]; ?>
    </div>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSZK9wtcrP7KzOLsSE2L53049S9c48yWQ">
    </script>
</body>
</html>