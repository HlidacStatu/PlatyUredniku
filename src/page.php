<!DOCTYPE html>
<html>
<head>

    <?php

    $meta["title"] = "Platy top úředníků";
    $meta["description"] = "";
    $meta["keywords"] = "";
    require_once dirname(__FILE__) . '/layout/head.php'; ?>


</head>

<body class="">


<?php

//$_SESSION["senddekujeme"] = true;
if($_SESSION["senddekujeme"] == true){
    $_SESSION["senddekujeme"] = false;

    ?>
    <div class="mess green">
        Zpráva byla odeslána. Děkujeme.
    </div>
    <?


}

?>

<div id="page">

    <?php  require_once dirname(__FILE__) . '/layout/top.php'; ?>


    <div class="block topblock bg-opacity " style="background-image: url(<?=photo($page->photo, "big", "/img/instituce.jpg"); ?>);">



            <div class="block-in">

                <h1><?=$page->title ?></h1>




            </div>

    </div>

    <div class="block  textpage">
        <div class="block-in">




<br>
<br>
<br>

                <?=$page->text ?>

            <div class="clear"></div>
            <br>
            <br>
            <br>
        </div></div>

    <?php if($page->rew == "kontakty"){ ?>
    <div class="block contactform  bg-opacity yellow"  style="background-image: url(/img/snemovna.jpg);">
        <div class="block-in">




            <br>
            <br>



                <h3>Kontaktujte nás</h3>
           <form method="post" action="/do/send" >

               <div class="col-4">
                   <input type="text" placeholder="Jméno" name="Jméno">
               </div>
               <div class="col-4">
                   <input type="email" placeholder="E-mail" name="E-mail" required>
               </div>
               <div class="col-4">
                   <input type="tel" placeholder="Telefon" name="Telefon">
               </div>
               <div class="clear"></div>
              <div class="col-12">
                  <textarea name="Text vzkazu" placeholder="Text vzkazu"></textarea>
              </div>

               <div class="col-4"></div>
               <div class="col-4"></div>
               <div class="col-4">
                   <input type="hidden" name="secure" id="secure">
                   <button type="submit" class="btn"><i class="fa fa-send"></i> Odeslat</button></div>
<div class="clear"></div>
           </form>

            <br>
            <br>
            <br>


            <div class="clear"></div>


        </div></div>

        <script>
            setTimeout(function(){
                $("#secure").val("<?php $h=md5(microtime()."platy"); echo $h; $_SESSION["secure"] = $h; ?>");
            });
        </script>

    <?php } ?>

    <?php  require_once dirname(__FILE__) . '/layout/bottom.php'; ?>



</div>
<!-- /#page -->
</body>

</html>
