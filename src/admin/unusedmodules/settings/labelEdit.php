<?php


if ($target!="-"){
    $data = seo::dejData($target);
}

$page = new page("Editace - ".$data["name"]);

$back = new button('<i class="fa fa-arrow-left"></i> Zpět', 'index', $id);
$back->returnBack();
echo $back->getString();

$page->title();


$form = new form();



$minimum = 4;
foreach (lang::dejArray() as $lang){
    // $tab = new tab("name-".$lang["short"], "4name");
    $name = new input("langtext".$lang["id"], $data, "Text v ".$lang["short"]);
    $name->editor();
    $minimum = 0;
    $form->add($name);
}



$form->plot();

 $save = new button('Uložit', 'pageSave', $id);
 $save->enterSubmit();
 echo $save->getString();

