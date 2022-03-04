<?php


if(isset($cat)){

    $pozice = pozice::dejByRew($cat, $instituce["id"]);
    if (!empty($pozice["id"])) {

        require_once dirname(__FILE__) . "/pozice.php";
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


    <div class="block topblock bg-opacity"  style="background-image: url(<?=photo($instituce["photo"], "big", "/img/instituce.jpg"); ?>);">

            <div class="block-in">


                <a class="btn a" href="/instituce"><i class="fa fa-arrow-left"></i> Instituce</a>
                <a class="btn a" href="/<?=$institucedruh["rew"]; ?>"><i class="fa fa-arrow-left"></i> <?=$institucedruh["name"]; ?></a>



                <a class="btn a csvbutton" href="/do/instituce-csv?r=<?=$instituce["rew"]; ?>"><i class="fa fa-file-excel-o"></i> Stáhnout *.csv</a>


                <h1>
                   <?=$instituce["name"]; ?>
                </h1>
                <span>
                    <?=$instituce["perex"]; ?>
                </span>
                <strong>
                    <?=$statusy[$m["status"]]; if($m["status"] == 2){ echo " ({$m["statusNote"]})"; } ?>
                </strong>

            </div>

    </div>




    <div class="block institucebloky">
        <div class="block-in">
            <div class="btnspace">

            <?php
            $statusy = instituce::statusy();
            $pozice = new sql("select rok from tbPlaty where isActive = 1 and isDel = 0 and pozice in ( select id from tbPozice where isActive = 1 and isDel = 0 and instituce = {$instituce["id"]} ) group by rok order by rok desc");

            $setRok = intval($_GET["rok"]);

            foreach ($pozice->all() as $m){

                if(empty($setRok)){
                    $setRok = $m["rok"];
                }
?>
        <a class="btn <?php if($setRok == $m["rok"]){ echo "aktivni";} ?>" href="?rok=<?=$m["rok"]; ?>"><?=$m["rok"]; ?></a>
                <?
            }

            ?>
            </div>
            <div class="clear"></div>

            <?php
            $statusy = instituce::statusy();
            $pozice = new sql("select p.name, p.rew, p.photo, l.rok, l.plat, l.odmeny, l.pocetmes, l.bonus from tbPozice p inner join tbPlaty l on p.id = l.pozice where p.isActive = 1 and p.isDel = 0 and l.isDel = 0 and l.isActive = 1 and p.instituce = {$instituce["id"]} and l.rok = $setRok order by p.ownOrder");
          //  echo_array($pozice->query);
            foreach ($pozice->all() as $m){

                ?>

                <div class="col-4">
<a href="/<?=$institucedruh["rew"];?>/<?=$instituce["rew"];?>/<?=$m["rew"];?>">
                    <div class="instituce-block">
                        <div class="instituce-block-in ZZZstatus-<?=$m["status"]; ?> bg-opacity black"  style="background-image: url(<?=photo($m["photo"], "medium", "/img/urednik.jpg"); ?>);">



                            <div class="over over2 noAbs">
                                <h2><?=$m["name"];?></h2>



                                <div class="status center noAbs">
                                    <?php


                                    if($m["pocetmes"] != 12){

                                        ?>
                                       příjem za <?=intval($m["pocetmes"]);

                                       if( ($m["pocetmes"] - intval($m["pocetmes"])) == .5 ){
                                           echo "½";
                                       }

                                       ?> <?
                                        if($m["pocetmes"] == 1){
                                            echo "mesíc";
                                        }elseif($m["pocetmes"] < 5){
                                            echo "měsíce";
                                        }else{
                                            echo "měsíců";
                                        }

                                        ?>:<br>
                                        <?=number_format(($m["plat"]+$m["odmeny"]/*+$m["bonus"]*/), 0, " ", " ");  ?> Kč <br><br>

                                        Průměrný roční hrubý příjem:<br>
                                        <?
                                        if(is_nan((($m["plat"]+$m["odmeny"]/*+$m["bonus"]*/)/$m["pocetmes"])*12)){
                                            echo "Neznámo";
                                        }else{
                                            ?>


                                            <?=number_format(((($m["plat"]+$m["odmeny"]/*+$m["bonus"]*/)/$m["pocetmes"])*12), 0, " ", " ");  ?> Kč <?
                                        }

                                    }else{
                                        ?>
                                        Roční hrubý příjem:<br>
                                        <?=number_format(($m["plat"]+$m["odmeny"]/*+$m["bonus"]*/), 0, " ", " ");  ?> Kč
                                        <?
                                    }
                                    ?>



                                </div>
                            </div>
                            <div class="btnblock">
                                <a class="btn a" href="/<?=$institucedruh["rew"];?>/<?=$instituce["rew"];?>/<?=$m["rew"];?>">Zobrazit pozici</a>
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







    <div class="block posledni bg-opacity yellow"  style="background-image: url(<?=photo($institucedruh["photo"], "big", "/img/snemovna.jpg"); ?>);">
        <div class="block-in">

            <h3>Poslední aktualizace</h3>

            <?php

            $aktuality = new sql("select * from tbAktuality where isDel = 0 and instituce = {$instituce["id"]}");
            foreach ($aktuality->all() as $a){

                ?>
                <article>
                    <span><?=dateformat($a["datum"]);?></span> <strong><?=$a["title"]; ?></strong> - <?=$a["perex"]; ?>
                </article>
                <?
            }

            ?>
        </div>
    </div>





    <?php  require_once dirname(__FILE__) . '/layout/bottom.php'; ?>



</div>
<!-- /#page -->
</body>

</html>
