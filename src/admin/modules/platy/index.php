<?php

$page = new page("Platy");

$create = new button('<i class="fa fa-plus"></i> Přidat plat', 'labelEdit', "-", "page", "green");
echo $create->getString();
	
$page->title();


$list = new listLoad("labelList");

$list->addLabel("Vše", "all", true);
$list->addLabel("Aktivní", "active");
$list->addLabel("Neaktivní", "non");
$list->addSort(pozice::returnArray());
$list->addsSearchLabel("Hledání...");

$list->loadThere();


?>
