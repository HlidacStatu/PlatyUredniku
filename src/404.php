<?php
header("HTTP/1.0 404 Not Found");

?><!DOCTYPE html>
<html>
<head>

  <?php

  $meta["title"] = "Platy top úředníků";
  $meta["description"] = "";
  $meta["keywords"] = "";
  require_once dirname(__FILE__) . '/layout/head.php'; ?>


</head>

<body class="">

<div id="page">

<?php  require_once dirname(__FILE__) . '/layout/top.php'; ?>


    <div class="block topblock bg-opacity" style="background-image: url(/img/snemovna.jpg);">



            <div class="block-in">
                <h1>
                #404
                </h1>
<strong>Stránka nenalezena</strong>


            </div>

    </div>

    <?php

    $vyraz = sql::escape($_GET["q"]);

    ?>

    <div class="block institucebloky">
        <div class="block-in">

            <br>
            <br>

            <h2></h2>
            <br>
            <br>
<div class="clear"></div>

            <div class="col-4">
                <a href="/">
                    <div class="instituce-block">
                        <div class="instituce-block-in  bg-opacity black" style="background-image: url(<?=photo($m["photo"], "medium", "/img/instituce.jpg"); ?>);">


                            <div class="over over2">
                                <h2>Instituce</h2>

                                <div class="status">
                                  Procházejte instituce
                                </div>
                            </div>

                            <div class="btnblock">
                                <a class="btn a" href="/instituce">Zobrazit</a>
            </div>

                        </div>
                    </div>
                </a>
            </div>

            <div class="col-4">
                <a href="/o-projektu">
                    <div class="instituce-block">
                        <div class="instituce-block-in   bg-opacity black" style="background-image: url(<?=photo($m["photo"], "medium", "/img/instituce.jpg"); ?>);">


                            <div class="over over2">
                                <h2>Informace o projektu</h2>

                                    <div class="status">
                                        Zjistěte více
                                    </div>
                            </div>

                            <div class="btnblock">
                                <a class="btn a" href="/o-projektu">Zobrazit</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-4">
                <a href="/hledani">
                    <div class="instituce-block">
                        <div class="instituce-block-in   bg-opacity black" style="background-image: url(<?=photo($m["photo"], "medium", "/img/instituce.jpg"); ?>);">


                            <div class="over over2">
                                <h2>Hledání</h2>

                                    <div class="status">
                                        Hledejte instituce nebo pozice
                                    </div>
                            </div>
                            <div class="btnblock">
                                <a class="btn a" href="/hledani">Zobrazit</a>
                            </div>

                        </div>
                    </div>
                </a>
            </div>



            <div class="clear"></div>
            <br>
            <br>
            <br>
        </div></div>

<?php  require_once dirname(__FILE__) . '/layout/bottom.php'; ?>



</div>
<!-- /#page -->
</body>

</html>
