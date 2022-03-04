<?php


        if(isset($rew)){

            $instituce = instituce::dejByRew($rew);
if (!empty($instituce["id"])) {
    require_once dirname(__FILE__) . "/instituce-detail.php";
    die;
}
        }

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


    <div class="block topblock bg-opacity"  style="background-image: url(<?=photo($institucedruh["photo"], "big", "/img/instituce.jpg"); ?>);">



            <div class="block-in">

                <a class="btn a" href="/instituce"><i class="fa fa-arrow-left"></i> Instituce</a>

                <a class="btn a csvbutton" href="/do/druhy-csv?r=<?=$institucedruh["rew"]; ?>"><i class="fa fa-file-excel-o"></i> Stáhnout *.csv</a>

                <h1>
                   <?=$institucedruh["name"]; ?>
                </h1>

        </div>
    </div>


    <div class="block institucebloky">
        <div class="block-in">

            <?php
            $statusy = instituce::statusy();
            $instituce = new sql("select * from tbInstituce where isActive = 1 and isDel = 0 and druh = {$institucedruh["id"]} order by ownOrder");
            foreach ($instituce->all() as $m){

                ?>

                <div class="col-3">

                    <a href="/<?=$institucedruh["rew"];?>/<?=$m["rew"];?>">
                    <div class="instituce-block">
                        <div class="instituce-block-in ZZZstatus-<?=$m["status"]; ?>  bg-opacity black"  style="background-image: url(<?=photo($m["photo"], "medium", "/img/instituce.jpg"); ?>);">


                            <div class="over over2">
                                <h2><?=$m["name"];?></h2>

                            </div>

                                <div class="status">

                                    <span class='part part2'><span class='info info<?=$m["status"]; ?>'></span> &nbsp; </span> <?=$statusy[$m["status"]];?> <br>

                                    <?php if(!empty($m["statusNote"])){ echo " <center>({$m["statusNote"]})</center>"; } ?>



                                </div>

                                <div class="btnblock">
                                    <a class="btn a" href="/<?=$institucedruh["rew"];?>/<?=$m["rew"];?>">Zobrazit pozice</a>
                                </div>



                        </div>
                    </div></a>
                </div>


                <?
            }

            ?>
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
