<?php

$page = new page("Druhy institucí");

$create = new button('<i class="fa fa-plus"></i> Přidat druh instituce', 'labelEdit', "-", "page", "green");
echo $create->getString();
	
$page->title();


$list = new listLoad("labelList");

$list->addLabel("Vše", "all", true);
$list->addLabel("Aktivní", "active");
$list->addLabel("Neaktivní", "non");
$list->addsSearchLabel("Hledání...");

$list->loadThere();


?>
