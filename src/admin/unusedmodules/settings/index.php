<?php
$page = new page("Nastavení");
$page->title();


$datazima = new sql("select * from tbObdobi where typ = 'zima'");
$datazima = $datazima->first();


$dataleto = new sql("select * from tbObdobi where typ = 'leto'");
$dataleto = $dataleto->first();

$form = new form();


$barva = array("zima" => "#2e71b8", "leto" => "#eab53e");
$obdobi = array("zima" => "Zima", "leto" => "Léto");

?>


<div class="formline">
    <div class="label">
        Aktuální sézóna:
    </div>
    <div class="input">
        <div style="margin: 0 0 10px 0;
    width: 100%;
    padding: 11px 10px;
    border-radius: 2px;
    border-style: none;
                color: white;
                background: <?=$barva[obdobi()]; ?>;
    font-size: 10pt;">
            <strong>Aktuální sezóna je: <?=$obdobi[obdobi()]; ?>. Příští automatická změna: <?
                if(strtotime(dateformat($dataleto["datum"], "j.n.").date("Y")) >= strtotime("now") ){
                    echo dateformat($dataleto["datum"], "j.n.").date("Y");
                    $na = "Léto";
                }elseif( strtotime(dateformat($datazima["datum"], "j.n.").date("Y")) >= strtotime("now")  ){
                    echo dateformat($datazima["datum"], "j.n.").date("Y");
                    $na = "Zima";
                }else{
                    echo dateformat($dataleto["datum"], "j.n.").(date("Y")+1);
                    $na = "Léto";
                }
                ?> na <?= $na; ?></strong>
        </div>
    </div>

</div>
<?


$page->breakPage();
$page->subtitle("Zima");

$input = new input("datezima", $datazima["datum"], "Začátek zimní sezóny");
$input->date('d.m.','dd.mm.');
$form->add($input);

$page->breakPage();
$page->subtitle("Léto");

$input = new input("dateleto", $dataleto["datum"], "Začátek letní sezóny");
$input->date('d.m.','dd.mm.');
$form->add($input);


$datasouradnince = souradnice("centrum");

$page->breakPage(); ?><br><?
$page->subtitle("Souřadnice centra města");

$input = new input("lat", $datasouradnince["lat"], "Lat");
$input->text();
$form->add($input);

$input = new input("lng", $datasouradnince["lng"], "Lng");
$input->text();
$form->add($input);

?>
<div class="clickmapplace">
    <div id="clickmap" style="width: 514px; height: 240px;"></div>
    <div class="btn a blue" id="findbygps">Použít tyto souřadnice</div><div class="info"></div>
    <script>  setTimeout(function () {initMap();  console.log("fdfs");}, 1000) </script>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<?

$page->breakPage(); ?><br><?
$page->subtitle("SEO Texty");

$query = "SELECT * FROM tbSEO where 1=1 ";

$data = new sql($query);
$out = "";
foreach ($data->all() as $zaznam) {
    $line = new line($zaznam["name"], $zaznam["id"]);
    $line->addIcon($zaznam["photo"], "img/page.png");
    $edit = new button('<i class="fa fa-pencil"></i> Upravit', 'labelEdit', $zaznam["id"]);
    $line->addButton($edit->getString());
    $out .= $line->getString();
}
echo $out;


$page->breakPage(); ?><br><?
$page->subtitle("Vleky v provozu");


$vleky = new sql("select * from tbVleky");
$vleky = $vleky->first();

$input = new input("vleky", $vleky["name"], "Vleky");
$input->text();
$form->add($input);

$form->plot();

$save = new button('Uložit', 'save', $id);
$save->enterSubmit();
echo $save->getString();

?>
