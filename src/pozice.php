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


    <div class="block topblock bg-opacity" style="background-image: url(<?=photo($pozice["photo"], "big", "/img/urednik.jpg"); ?>);">


            <div class="block-in">

                <a class="btn a" href="/instituce"><i class="fa fa-arrow-left"></i> Instituce</a>
                <a class="btn a" href="/<?=$institucedruh["rew"]; ?>"><i class="fa fa-arrow-left"></i> <?=$institucedruh["name"]; ?></a>
                <a class="btn a" href="/<?=$institucedruh["rew"]; ?>/<?=$instituce["rew"]; ?>"><i class="fa fa-arrow-left"></i> <?=$instituce["name"]; ?></a>


                <a class="btn a csvbutton" href="/do/pozice-csv?r=<?=$pozice["rew"]; ?>"><i class="fa fa-file-excel-o"></i> Stáhnout *.csv</a>



                <h1>
                   <?=$pozice["name"]; ?>
                </h1>
                <span>
                    <?=$pozice["perex"]; ?>
                </span>



            </div>

    </div>




    <div class="block posledni">
        <div class="block-in">
            <h3>Poslední zjištěný plat</h3>



                <?php
                $statusy = instituce::statusy();
                $tmp = new sql("select *  from tbPlaty where isActive = 1 and isDel = 0 and pozice = {$pozice["id"]} order by rok desc limit 0,1");
                //  echo_array($pozice->query);
                foreach ($tmp->all() as $m){




            if( ($m["pocetmes"] - intval($m["pocetmes"])) == .5 ){
                $m["pocetmes"] = intval($m["pocetmes"])."½";
            }

            ?>

            <div class="col-6 grafcol">

    <h1><?=$m["rok"]; ?></h1>
    <table>

        <tr><td>Plat (hrubý příjem): </td><td><strong><?=number_format($m["plat"], 0, " ", " "); ?> Kč</strong></td></tr>
        <tr><td>Odměny / náhrady (hrubý příjem): </td><td><strong><?=number_format($m["odmeny"], 0, " ", " "); ?> Kč</strong></td></tr>
        <?php if(false){ ?>     <tr><td>Bonusy: </td><td><strong><?=number_format($m["bonus"], 0, " ", " "); ?> Kč</strong></td></tr>  <?php } ?>
        <tr><td>Nefinanční bonusy: </td><td><strong><?=$m["nefbonus"]; ?></strong></td></tr>
        <tr><td>Celkový roční hrubý příjem bez nefinančních bonusů: </td><td><strong><?=number_format(($m["plat"]+$m["odmeny"]/*+$m["bonus"]*/), 0, " ", " "); ?> Kč</strong></td></tr>
        <tr><td>Odpracováno měsíců: </td><td><strong><?=$m["pocetmes"]; ?></strong></td></tr>
    </table>

</div>
                    <div class="col-6 grafcol2">


                        <?php if(false){ ?>
                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">

                            // Load the Visualization API and the corechart package.
                            google.charts.load('current', {'packages':['corechart']});

                            // Set a callback to run when the Google Visualization API is loaded.
                            google.charts.setOnLoadCallback(drawChart);

                            // Callback that creates and populates a data table,
                            // instantiates the pie chart, passes in the data and
                            // draws it.
                            function drawChart() {

                                // Create the data table.
                                var data = new google.visualization.DataTable();
                                data.addColumn('string', 'title');
                                data.addColumn('number', 'value');
                                data.addRows([
                                    ['Plat', <?=intval($m["plat"]); ?>],
                                    ['Odměny / náhrady', <?=intval($m["odmeny"]); ?>],
                                    ['Bonusy', <?=intval($m["bonus"]); ?>]
                                ]);

                                // Set chart options
                                var options = {
                                    'is3D':true,
                                    'fontSize':'16',
                                    'backgroundColor': 'transparent',
                                    'height':250};

                                // Instantiate and draw our chart, passing in some options.
                                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                                chart.draw(data, options);
                            }
                        </script>
                        <div id="chart_div"></div>

        <?php } ?>

                        <div class="col-6">

                                <svg width="75%" viewBox="0 0 42 42" class="donut" style="margin: 0 auto; display:block;">
                                    <circle class="donut-hole" cx="21" cy="21" r="15.91549430918954" fill="transparent"></circle>
                                    <circle class="donut-ring" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#585858" stroke-width="3"></circle>



                                    <?php


                                    $stcelkem = intval($m["plat"])+intval($m["odmeny"])/*+intval($m["bonus"])*/;

                                    $st[1] = ((100/$stcelkem) * intval($m["plat"]));
                                    $st[2] = ((100/$stcelkem) * intval($m["odmeny"]));
                                    $st[3] = ((100/$stcelkem) * intval($m["bonus"]));

                                    ?>

                                    <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#f5ad00" stroke-width="3" stroke-dasharray="<?=$st[1]; ?> <?=$st[2]/*+$st[3]*/; ?>" stroke-dashoffset="25"></circle>
                                    <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#0c314e" stroke-width="3" stroke-dasharray="<?=$st[2]; ?> <?=$st[1]/*+$st[3]*/; ?>" stroke-dashoffset="<?=(100-($st[1])+25); ?>"></circle>
                                    <?php if(false){ ?>       <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#585858" stroke-width="3" stroke-dasharray="<?=$st[3]; ?> <?=$st[1]+$st[2]; ?>" stroke-dashoffset="<?=(100-($st[1]+$st[2])+25); ?>"></circle><?php } ?>

                                </svg>

                        </div>
                        <div class="col-6">

                            <div class="legenda">



                                <span class='part'><span class='info infoA'></span> &nbsp;<strong><?=round($st[1]); ?> %</strong> </span> Hrubý plat <br>
                                <span class='part'><span class='info infoB'></span> &nbsp;<strong><?=round($st[2]); ?> %</strong> </span> Odměny / náhrady <br>
                                <?php if(false){ ?>    <span class='part'><span class='info infoC'></span> &nbsp;<strong><?=round($st[3]); ?> %</strong> </span> Bonus <br><?php } ?>

                            </div>
                        </div>

                    </div>
                    <div class="clear"></div>
<?php } ?>
        </div>
    </div>



    <?php if(false){ ?>
        <div class="block tableplat bg-opacity yellow"  style="background-image: url(<?=photo($instituce["photo"], "big", "/img/snemovna.jpg"); ?>);">
        <div class="block-in">
            <h3>Historie platu</h3>

            <div class="aroundtable">

            <table>
                <tr>
                    <td>Rok</td>
                    <td>Plat</td>
                    <td>Odměny / náhrady</td>
                    <?php if(false){ ?>     <td>Bonusy</td><?php } ?>
                    <td>Nefinanční bonusy</td>
                    <td>Celkový roční příjem bez nefinančních bonusů</td>
                    <td>Odpracováno měsíců</td>
                </tr>

                <?php
                $statusy = instituce::statusy();
                $tmp = new sql("select *  from tbPlaty where isActive = 1 and isDel = 0 and pozice = {$pozice["id"]} order by rok desc ");
                //  echo_array($pozice->query);
                foreach ($tmp->all() as $m){


                    if( ($m["pocetmes"] - intval($m["pocetmes"])) == .5 ){

                        $m["pocetmes"] = intval($m["pocetmes"])."½";

                    }

                    ?>

                <tr>
                    <td><?=$m["rok"]; ?></td>
                    <td><?=number_format($m["plat"], 0, " ", " "); ?> Kč</td>
                    <td><?=number_format($m["odmeny"], 0, " ", " "); ?> Kč</td>
                   <?php if(false){ ?> <td><?=number_format($m["bonus"], 0, " ", " "); ?> Kč</td> <?php } ?>
                    <td><?=$m["nefbonus"]; ?></td>
                    <td><?=number_format(($m["plat"]+$m["odmeny"]+$m["bonus"]), 0, " ", " "); ?> Kč</td>
                    <td><?=$m["pocetmes"]; ?></td>
                </tr>

                <?php } ?>
            </table>

            </div>

            <div class="clear"></div>


        </div></div>
<?php } ?>


    <div class="block institucebloky souvispoz">
        <div class="block-in">

            <h3>Související pozice</h3>

            <div class="clear"></div>


            <?php



            $query = "select p.name, p.rew, p.photo, l.rok, l.plat, l.odmeny, l.pocetmes, l.bonus from tbPozice p inner join tbPlaty l on p.id = l.pozice where p.isActive = 1 and p.isDel = 0 and l.isDel = 0 and ( p.id in (select poziceA from tbPoziceSouvisejici where poziceB = {$pozice["id"]} ) or p.id in (select poziceB from tbPoziceSouvisejici  where poziceA = {$pozice["id"]} ) ) order by ownOrder";


            $tmp = new sql($query);

$is = false;

            foreach ($tmp->all() as $m){

                $is = true;

                ?>



            <div class="col-4">
                <a href="/<?=$institucedruh["rew"];?>/<?=$instituce["rew"];?>/<?=$m["rew"];?>">
                    <div class="instituce-block">
                        <div class="instituce-block-in ZZZstatus-<?=$m["status"]; ?> bg-opacity black"  style="background-image: url(<?=photo($m["photo"], "medium", "/img/instituce.jpg"); ?>);">


                            <div class="over over2 noAbs">
                                <h2><?=$m["name"];?></h2>



                            <div class="status center noAbs">
                                <?php


                                if($m["pocetmes"] != 12){

                                    ?>
                                    příjem za <?=$m["pocetmes"]; ?> <?
                                    if($m["pocetmes"] == 1){
                                        echo "mesíc";
                                    }elseif($m["pocetmes"] < 5){
                                        echo "měsíce";
                                    }else{
                                        echo "měsíců";
                                    }


                                    ?>:<br>
                                    <?=number_format(($m["plat"]+$m["odmeny"]+$m["bonus"]), 0, " ", " ");  ?> Kč <br><br>

                                    Průměrný roční příjem:<br>
                                    <?=number_format(((($m["plat"]+$m["odmeny"]+$m["bonus"])/$m["pocetmes"])*12), 0, " ", " ");  ?> Kč
                                    <?
                                }else{
                                    ?>
                                    Průměrný roční příjem:<br>
                                    <?=number_format(((($m["plat"]+$m["odmeny"]+$m["bonus"])/$m["pocetmes"])*12), 0, " ", " ");  ?> Kč
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

            if(!$is){
                ?> <script>$(".souvispoz").remove();</script><?

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
