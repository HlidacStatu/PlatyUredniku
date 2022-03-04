<!DOCTYPE html>
<html>
<head>

  <?php

  if(isset($rew)){
      $aktualita = aktuality::dejByRew($rew);
  }
  if(!empty($aktualita)){
      $meta["title"] = "Platy top úředníků - {$aktualita["title"]}";
  }else{
      $meta["title"] = "Platy top úředníků - Aktuality";
  }
  $meta["description"] = "";
  $meta["keywords"] = "";


  $rocket["metaimage"] = "/img/pu-og-aktualita.png";
  $rocket["metaimageheight"] = "994";
  $rocket["metaimagewidth"] = "3144";

  require_once dirname(__FILE__) . '/layout/head.php';

  ?>

</head>
<body>



<div id="page">

    <?php  require_once dirname(__FILE__) . '/layout/top.php'; ?>





        <?php

        if(!empty($aktualita)){
            ?>

    <div class="block topblock bg-opacity yellow" style="background-image: url(<?=photo($aktualita["photo"], "big", "/img/snemovna.jpg"); ?>);">



            <div class="block-in">

                <h1><?=$aktualita["title"]; ?></h1>




            </div>

    </div>

    <div class="block textpage">
        <div class="block-in">




            <br>
            <br>
            <br>

            <div class="perex">
                <?=$aktualita["perex"]; ?>
            </div><!-- /perex -->

            <?=$aktualita["text"]; ?>
            <span class="small">
                Datum zveřejnění: <span class="blue"><?=dateformat($aktualita["datum"]); ?></span>, Autor:  <span class="blue"><?=$aktualita["autor"]; ?></span>
</span>




                <!-- /OBSAH -->

            <div class="clear"></div>
            <br>
            <a class="btn" href="/aktuality">Zpět na všechny aktuality</a>

        </div>
    </div>
            <?php
        }else{
            ?>





        <div class="block posledni bg-opacity yellow"  style="background-image: url(<?=photo($aktualita["photo"], "big", "/img/snemovna.jpg"); ?>);">
        <div class="over">
            <div class="block-in">

                <h1>Aktuality</h1>


                <br>
                <br>
                <br>






                <?php

                $pagerhref = "/aktuality";

                $queryC = "SELECT count(id) as celkem FROM tbAktuality where isDel = 0 and instituce = 0 order by datum desc";

                $tmp = new sql($queryC);
                $count = $tmp->first();
                $count = $count["celkem"];


               //
                $maxzaznam = 10;
                if(!isset($_GET["page"])){ $_GET["page"] = 1; }
                $page = intval($_GET["page"]);
                $maxpage = ceil($count/$maxzaznam);


                $limit = (($page-1)*$maxzaznam).",".$maxzaznam;


                $query = "SELECT * FROM tbAktuality where isDel = 0  and instituce = 0  order by datum desc LIMIT $limit";

                $data = new sql($query);
                foreach ($data->all() as $a) {

                    ?>

                    <article>

                        <a href="/aktuality/<?=$a["rew"]; ?>">
                            <h3><?=$a["title"]; ?></h3>
                            <span><?=dateformat($a["datum"]);?></span> - <?=$a["perex"]; ?>

                        </a>
                    </article>





                <?php } ?>


<br>
<br>
                <div class="navig">
                    <p>

     <span>
    <?php if($page > 4){ ?>
        <a href="<?=$pagerhref; ?>?page=1">1</a><a href="<?=$pagerhref; ?>?page=2">2</a>
    <?php }elseif($page > 3){ ?>
        <a href="<?=$pagerhref; ?>?page=1">1</a>
    <?php } ?>
    </span>
    <span>
        <?php
        if($page > 2){
            ?><a href="<?=$pagerhref; ?>?page=<?=$page-2; ?>"><?=$page-2; ?></a><a href="<?=$pagerhref; ?>?page=<?=$page-1; ?>"><?=$page-1; ?></a><?php
        }elseif($page > 1){
            ?><a href="<?=$pagerhref; ?>?page=<?=$page-1; ?>"><?=$page-1; ?></a><?php
        }
        ?><strong><?=$page; ?></strong><?php
        if($page < $maxpage-1){
            ?><a href="<?=$pagerhref; ?>?page=<?=$page+1; ?>"><?=$page+1; ?></a><a href="<?=$pagerhref; ?>?page=<?=$page+2; ?>"><?=$page+2; ?></a><?php
        }elseif($page < $maxpage){
            ?><a href="<?=$pagerhref; ?>?page=<?=$page+1; ?>"><?=$page+1; ?></a><?php
        }
        ?>
    </span>
     <span>
    <?php if($page < $maxpage-3){ ?>
        <a href="<?=$pagerhref; ?>?page=<?=$maxpage-1; ?>"><?=$maxpage-1; ?></a><a href="<?=$pagerhref; ?>?page=<?=$maxpage; ?>"><?=$maxpage; ?></a>
    <?php }elseif($page < $maxpage-2){ ?>
        <a href="<?=$pagerhref; ?>?page=<?=$maxpage; ?>"><?=$maxpage; ?></a>
    <?php }
    ?>
    </span>
                    </p>
                    <p>

                    </p>
                </div><!-- /navig -->
            <br>
            <br>

        </div>
    </div>

        <?php } ?>







        <div class="clear"></div>
    </div>

    <div class="right col-3">
        <?php  require_once dirname(__FILE__) . '/layout/right.php'; ?>
    </div>
    <div class="clear"></div>

</div>
<div class="clear"></div>

<?php  require_once dirname(__FILE__) . '/layout/bottom.php'; ?>





</body>
</html>
