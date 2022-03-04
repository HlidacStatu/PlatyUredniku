<?php
$data = pozice::dejData($target);

$page = new page("Editace platů - ".$data["name"]);
	
$back = new button('<i class="fa fa-arrow-left"></i> Zpět', 'index', $id);
$back->returnBack();
echo $back->getString();

$page->title();



$create = new button('<i class="fa fa-plus"></i> Přidat plat', 'platEdit', "-", "page", "green");
$create->addSource($target);
echo $create->getString();
echo "<br><br><br>";

$data = new sql("SELECT * FROM tbPlaty where isDel = 0 and pozice = $target ");

$out = "";

$pozice = pozice::returnArray();
foreach ($data->all() as $zaznam) {
    $line = new line($pozice[$zaznam["pozice"]]);
    $line->addIcon($zaznam["photo"], "/admin/img/tag.png");
    $line->addNote($zaznam["rok"]);
    $line->addNote($zaznam["plat"]."/".$zaznam["odmeny"]."/".$zaznam["bonus"]."/".$zaznam["nefbonus"]);
    $del = new button('<i class="fa fa-times"></i> Smazat', 'platDel', $zaznam["id"], "del", "red");
    $edit = new button('<i class="fa fa-pencil"></i> Upravit', 'platEdit', $zaznam["id"]);

    $del->addSource($target);
    $edit->addSource($target);
    $line->addButton($del->getString());
    $line->addButton($edit->getString());

    $out .= $line->getString();
}
echo $out;