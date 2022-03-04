<?php

$page = new page("Pozice");

$create = new button('<i class="fa fa-plus"></i> Přidat pozici', 'labelEdit', "-", "page", "green");
echo $create->getString();
	
$page->title();


$list = new listLoad("labelList");

$list->addLabel("Vše", "all", true);
$list->addLabel("Aktivní", "active");
$list->addLabel("Neaktivní", "non");
$list->addSort(instituce::returnArray());

$list->addsSearchLabel("Hledání...");

$list->loadThere();


?>
