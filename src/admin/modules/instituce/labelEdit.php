<?php 

$page = new page("Editace štítku");
	
$back = new button('<i class="fa fa-arrow-left"></i> Zpět', 'index', $id);
$back->returnBack();
echo $back->getString();

$page->title();

$data["isActive"] = 1;
if ($target!="-"){
     $data = instituce::dejData($target);
}


$form = new form();





$name = new input("name", $data, "Název");
$name->text(4);
$form->add($name);






$isActive = new input("status", $data, "Status");
$isActive->select(instituce::statusy());
$form->add($isActive);
$name = new input("statusNote", $data, "Poznámka ke statusu");
$name->text();
$form->add($name);



$name = new input("druh", $data, "Druh");
$name->select(institucedruh::dejArray());
$form->add($name);


$name = new input("photo", $data, "Fotografie");
$name->image();
$form->add($name);

$name = new input("note", $data, "Interní poznámka");
$name->textarea();
$form->add($name);


$name = new input("perex", $data, "Veřejný popis");
$name->editor();
$form->add($name);



$name = new input("contacts", $data, "Kontakty");
$name->editor();
$name->help("Telefon, web, atd.");
$form->add($name);




$isActive = new input("isActive", $data, "Aktivní");
$isActive->option("Ano", "Ne");
$form->add($isActive);

$form->plot();

 $save = new button('Uložit', 'labelSave', $id);
 $save->enterSubmit();
 echo $save->getString();

