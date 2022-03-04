
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">

    <script> var module = "home"; var rootName = "<?php echo $rocket["name"]; ?>"; //default module index </script>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700&subset=latin-ext' rel='stylesheet' type='text/css'>
    <script type='text/javascript' src='https://code.jquery.com/jquery-latest.min.js'></script>


    <meta name="theme-color" content="white">

    <link rel="stylesheet" href="/admin/style/template.css" type="text/css">
    <link rel="stylesheet" href="/admin/style/editor.css" type="text/css">



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
    <script src="/admin/scripts/jquery-ui.min.js"></script>

    <script type='text/javascript' src='/admin/scripts/mainControler.js'></script>
    <script type='text/javascript' src='/admin/scripts/btnControler.js'></script>

    <script type='text/javascript' src='/admin/scripts/uploader.js'></script>
    <script type='text/javascript' src='/admin/scripts/editor.js'></script>
</head>
<body style="display: flex; align-items: center; ">


    <div class="login">
        
        <div class="in" style='padding: 10px;'>

            <img class="logo" src="<?php echo $rocket["adminLogo"]; ?>" height="40px">
            <?php alert::show(); ?>


            <?php
            if (isset($_COOKIE['TinyRocket_LastUser'])) { 
                $user = user::dataProLogin($_COOKIE["TinyRocket_LastUser"]);
            ?>
            <form action="/admin/modules/users/login.php" method="post" class="loginForm">
            <div class="login-photo bck-cover" style="background-image: url('<?php echo photo($user["photo"], "medium", "img/user.png"); ?>');"></div>
            <strong><?php echo $user["name"]; ?></strong>
            <input type="text"  type="login" class="a" placeholder="E-mail" name="mail" value="<?php echo $user["mail"]; ?>" style="display:none;">
            <input type="password"   class="a" placeholder="Heslo" name="pass">
            <cetner><input  type="submit" class="a btn" value="Přihlášení"></cetner>
            </form>
            <?php }else{
                $hrs = date("H");
                if ($hrs > 4)
                    $msg = "Dobré ráno";
                if ($hrs > 9)
                    $msg = "Dobrý den";
                if ($hrs > 17)
                    $msg = "Dobrý večer";
                echo "<h1 style='text-align: left; margin: 0 0 10px 0;font-weight: 200;font-size: 18pt;'>$msg.</h1>";
                ?>
            <form action="/admin/modules/users/login.php" method="post" class="loginForm">
            <input type="text"  type="login" class="a" placeholder="Přihlašovací jméno" name="mail">
            <input type="password"   class="a" placeholder="Heslo" name="pass">
            <cetner><input  type="submit" class="a btn" value="Přihlášení"></cetner>
            </form>
            <?php } ?>
            
             <div class="clear"></div>

              <?php if (isset($_COOKIE['TinyRocket_LastUser'])) {   $_SESSION["lastUrl"] = selfURL("ano"); ?>
             <p class='info'>
                Chcete se přihlásit jiným účtem? <a href="modules/users/delCookie.php?n=TinyRocket_LastUser">Klikněte zde</a>
             </p>
                  
              <?php }else{ ?>
       <!--     <p>
                Zapoměli jste své heslo? <a href="newPass">Klikněte zde</a>
            </p>
            <p>
                Máte problémy s přihlášením? <a href="support">Klikněte zde</a>
            </p>  -->
              <?php } ?>
        </div>
   
        
    </div>
</body>
</html>