<?php 

$page = new page("Editace článku");
	
$back = new button('<i class="fa fa-arrow-left"></i> Zpět', 'index', $id);
$back->returnBack();
echo $back->getString();

$page->title();


$data["onHp"] = 0;
$galleryID = 0;
if ($target!="-"){
     $data = aktuality::dejData($target);
     $galleryID = $target;
}


$form = new form();



/*
$tabs = new tabControl("4title", "small");
foreach (lang::dejArray() as $lang){
    $tabs->addTab($lang["name"], "title-".$lang["short"]);
}
$tabs->plotThere();
*/


   // $tab = new tab("title-".$lang["short"], "4title");
    $name = new input("title", $data, "Název");
    $name->text(4);
    $minimum = 0;
    $form->add($name);



$name = new input("instituce", $data, "Instituce");

$arr1 = array("0" => "Žádná");
$arr2 = instituce::returnArray();
$name->select($arr1 + $arr2);
$form->add($name);


$isActive = new input("onHp", $data, "Zobrazovat na úvodní stránce");
$isActive->option("Ano", "Ne");
$form->add($isActive);



$name = new input("datum", $data, "Datum");
$name->date();
$form->add($name);



$input = new input("perex", $data, "Perex");
    $input->editor();
    $form->add($input);

    $input = new input("text", $data, "Text");
    $input->editor();
    $form->add($input);






$name = new input("photo", $data, "Fotografie");
$name->image();
$form->add($name);



$name = new input("autor", $data, "Autor");
$name->text();
$form->add($name);





$form->plot();

 $save = new button('Uložit', 'pageSave', $id);
 $save->enterSubmit();
 echo $save->getString();

