<?php

$page = new page("Instituce");

$create = new button('<i class="fa fa-plus"></i> Přidat instituci', 'labelEdit', "-", "page", "green");
echo $create->getString();
	
$page->title();


$list = new listLoad("labelList");

$list->addLabel("Vše", "all", true);
$list->addLabel("Aktivní", "active");
$list->addLabel("Neaktivní", "non");

$list->addSort(institucedruh::returnArray());
$list->addsSearchLabel("Hledání...");

$list->loadThere();


?>
