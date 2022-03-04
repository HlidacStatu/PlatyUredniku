<?php 

$page = new page("Editace platu");
	
$back = new button('<i class="fa fa-arrow-left"></i> Zpět', 'index', $id);
$back->returnBack();
echo $back->getString();

$page->title();

$data["isActive"] = 1;
$data["rok"] = 2017;
if ($target!="-"){
     $data = platy::dejData($target);
}


$form = new form();


$name = new input("name", $data, "Poznamka");
$name->text(0);
$form->add($name);


$name = new input("pozice", $data, "Pozice");
$name->select(pozice::returnArray());
$form->add($name);

$roky = array();
$rok = date("Y");
while($rok > 1999){
    $roky[$rok] = $rok;
    $rok--;
}
$name = new input("rok", $data, "Rok");
$name->select($roky);
$form->add($name);


$name = new input("plat", $data, "Plat");
$name->text();
$form->add($name);

$name = new input("odmeny", $data, "Odměny / náhrady");
$name->text();
$form->add($name);


$name = new input("bonus", $data, "Bonus");
$name->text();
//$form->add($name);

$name = new input("nefbonus", $data, "Nefinanční bonus");
$name->text();
$form->add($name);

$mesice = array();
$mesic = 12;
while($mesic > 0){
    $mesice[$mesic] = $mesic; 
    $mesic = $mesic-0.5;
}
$name = new input("pocetmes", $data, "Počet měsíců");
$name->select($mesice);
$form->add($name);





$isActive = new input("isActive", $data, "Aktivní");
$isActive->option("Ano", "Ne");
$form->add($isActive);

$form->plot();

 $save = new button('Uložit', 'labelSave', $id);
 $save->enterSubmit();
 echo $save->getString();

