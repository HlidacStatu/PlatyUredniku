<?php


$out .= "Skupina;Instituce;Pozice;Rok;Plat;Odmeny;Nefinancni bonusy;Celkovy rocni prijem bez nefinancnich bonusu;Odpracovano mesicu";




new sql("SET character_set_results=cp1250, character_set_connection=cp1250, character_set_client=cp1250");






$instituce = instituce::dejByRew(valid($_GET["r"]));
$institucedruh = institucedruh::dejData(valid($instituce["druh"]));


$poziceall = new sql("select * from tbPozice where isDel = 0 and isActive = 1 and instituce = {$instituce["id"]} order by ownOrder");
foreach ($poziceall->all() as $pozice) {

    $tmp = new sql("select *  from tbPlaty where isActive = 1 and isDel = 0 and pozice = {$pozice["id"]} order by rok desc ");
    //  echo_array($pozice->query);
    foreach ($tmp->all() as $m) {


        $rok = $m["rok"];
        $plat = number_format($m["plat"], 0, " ", " ") . iconv('UTF-8', 'cp1250', " Kč");
        $odmeny = number_format($m["odmeny"], 0, " ", " ") . iconv('UTF-8', 'cp1250', " Kč");
        $bonus = number_format($m["bonus"], 0, " ", " ") . iconv('UTF-8', 'cp1250', " Kč");
        $nefbonus = $m["nefbonus"];
        $celkem = number_format(($m["plat"] + $m["odmeny"] + $m["bonus"]), 0, " ", " ") . iconv('UTF-8', 'cp1250', " Kč");
        $mesicu = $m["pocetmes"];


        $out .= "
{$institucedruh["name"]};{$instituce["name"]};{$pozice["name"]};$rok;$plat;$odmeny;$nefbonus;$celkem;$mesicu";


    }


}


$out .= "
Zdroj:;https://www.platytopuredniku.cz";

$out .= "
".iconv('UTF-8', 'cp1250', "Vytvořeno").":;".date("j.n.Y H:i");

header('Content-Type: text/csv; charset=cp1250');
header('Content-Disposition: attachment; filename='.valid($_GET["r"]).'-platytopuredniku-cz.csv');




ob_clean();print_r($out);

