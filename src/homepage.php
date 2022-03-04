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

<div id="page">

<?php  require_once dirname(__FILE__) . '/layout/top.php'; ?>


    <div class="block topblock bg-opacity" style="background-image: url(/img/snemovna.jpg);">


            <div class="block-in">


                <h1>
                    Platy úředníků
                </h1>

                <strong>
                    Chcete vědět, jaké platy mají nejvýše postavení úředníci českých institucí?
                </strong>
                <strong>
                    Chcete mít přehled o tom, které instituce jsou ochotné tato data zveřejňovat?
                </strong>

          <strong>      <a class="btn a btn2" href="/instituce">     Ano, chci mít přehled</a>
          </strong>

            </div>

    </div>




<?php  require_once dirname(__FILE__) . '/instituce-list.php'; ?>



    <div class="block institucebloky">
        <div class="block-in">


            <h2>Nejhledanější pozice</h2>
            <div class="clear"></div>

            <?php

            $pozice = new sql("select * from tbPozice where isActive = 1 and isDel = 0 order by views desc limit 0,3 ");
            //  echo_array($pozice->query);
            foreach ($pozice->all() as $m){

               $lastplat = new sql("select * from tbPlaty where pozice = {$m["id"]} and isActive = 1 and isDel = 0 order by rok desc limit 0,1");
               $lastplat = $lastplat->first();

                $instituceP = new sql("select * from tbInstituce where id = {$m["instituce"]} ");
                $instituceP = $instituceP->first();


                $instituceD = new sql("select * from tbInstituceDruh where id = {$instituceP["druh"]} ");
                $instituceD = $instituceD->first();


                ?>


                <div class="col-4">
                    <a href="/<?=$instituceD["rew"];?>/<?=$instituceP["rew"];?>/<?=$m["rew"];?>">
                        <div class="instituce-block">
                            <div class="instituce-block-in ZZZstatus-<?=$m["status"]; ?> bg-opacity black"  style="background-image: url(<?=photo($m["photo"], "medium", "/img/urednik.jpg"); ?>);">



                                <div class="over over2 noAbs">
                                    <h2><?=$m["name"];?></h2>



                                    <div class="status center noAbs">


                                        <?php


                                        if($lastplat["pocetmes"] != 12){

                                            ?>
                                            příjem za <?=intval($lastplat["pocetmes"]);

                                            if( ($lastplat["pocetmes"] - intval($lastplat["pocetmes"])) == .5 ){
                                                echo "½";
                                            }

                                            ?> <?
                                            if($lastplat["pocetmes"] == 1){
                                                echo "mesíc";
                                            }elseif($lastplat["pocetmes"] < 5){
                                                echo "měsíce";
                                            }else{
                                                echo "měsíců";
                                            }

                                            ?>:<br>
                                            <?=number_format(($lastplat["plat"]+$lastplat["odmeny"]/*+$m["bonus"]*/), 0, " ", " ");  ?> Kč <br><br>

                                            Průměrný roční hrubý příjem:<br>
                                            <?
                                            if(is_nan((($lastplat["plat"]+$lastplat["odmeny"]/*+$m["bonus"]*/)/$lastplat["pocetmes"])*12)){
                                                echo "Neznámo";
                                            }else{
                                                ?>


                                                <?=number_format(((($lastplat["plat"]+$lastplat["odmeny"]/*+$m["bonus"]*/)/$lastplat["pocetmes"])*12), 0, " ", " ");  ?> Kč <?
                                            }

                                        }else{
                                            ?>
                                            Roční hrubý příjem:<br>
                                            <?=number_format(($lastplat["plat"]+$lastplat["odmeny"]/*+$m["bonus"]*/), 0, " ", " ");  ?> Kč
                                            <?
                                        }
                                        ?>


                                    </div>
                                </div>
                                <div class="btnblock">
                                    <a class="btn a" href="/<?=$instituceD["rew"];?>/<?=$instituceP["rew"];?>/<?=$m["rew"];?>">Zobrazit pozici</a>
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



    <div class="block posledni bg-opacity yellow"  style="background-image: url(/img/snemovna.jpg);">
        <div class="block-in">

            <?php if(false){ ?>
            <h3>Poslední aktualizace</h3>

            <?php

            $aktuality = new sql("select * from tbAktuality where isDel = 0 and onHp = 1 and instituce <> 0 limit 0,3 order by datum desc");
            foreach ($aktuality->all() as $a){

                ?>
                <article>
                    <span><?=dateformat($a["datum"]);?></span> <strong><?=$a["title"]; ?> <?php if($a["instituce"] != 0){ $ins = instituce::dejData($a["instituce"]); echo " - {$ins["name"]}"; }?></strong> - <?=$a["perex"]; ?>
                </article>
                <?
            }

            ?>


            <br>
            <br>
            <br>
            <br>
 <?php } ?>

            <h3>Aktuality</h3>

            <?php

            $aktuality = new sql("select * from tbAktuality where isDel = 0 and onHp = 1 and instituce = 0 order by datum desc limit 0,3 ");
            foreach ($aktuality->all() as $a){

                ?>
                <article>

                    <a href="/aktuality/<?=$a["rew"]; ?>">
                        <h5><?=$a["title"]; ?></h5>
                    <span><?=dateformat($a["datum"]);?></span> - <?=$a["perex"]; ?>

                    </a>
                </article>
                <?
            }

            ?>

            <br>
            <a class="btn" href="/aktuality">Zobrazit všechny aktuality</a>
            <br>
        </div>
    </div>


    <?php  require_once dirname(__FILE__) . '/layout/bottom.php'; ?>



</div>
<!-- /#page -->
</body>

</html>
