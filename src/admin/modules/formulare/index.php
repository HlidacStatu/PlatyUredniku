<?php




$page = new page("Odeslané formuláře");
$page->title();


$list = new listLoad("labelList");

$list->addLabel("Vše", "all", true);

if(usertype("admin")) {
    $list->addsSearchLabel("Hledání podle objektu");
}else{
    $list->addsSearchLabel("Hledání...");
}

$list->loadThere();
