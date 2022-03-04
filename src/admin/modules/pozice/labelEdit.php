<?php 

$page = new page("Editace pozice");
	
$back = new button('<i class="fa fa-arrow-left"></i> Zpět', 'index', $id);
$back->returnBack();
echo $back->getString();

$page->title();

$data["isActive"] = 1;
if ($target!="-"){
     $data = pozice::dejData($target);
}


$form = new form();


$name = new input("name", $data, "Název");
$name->text(4);
$form->add($name);



$name = new input("instituce", $data, "Instituce");
$name->select(instituce::returnArray());
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



$arr = pozice::dejArray($target);
$data["souvisejici"]  = pozice::dejSouvisejici($target);


$input = new input("souvisejici", $data, "Související pozice");
$input->placeholder("Začněte psát název související pozice");
$input->labelsSearch($arr);
$form->add($input);



$isActive = new input("isActive", $data, "Aktivní");
$isActive->option("Ano", "Ne");
$form->add($isActive);




$isActive = new input("continueToPlat", 0, "Pokračovat na přidání platu");
$isActive->option("Ano", "Ne");
$form->add($isActive);


/*
$i = 1;
while($i < 5) {

    $form->add("<hr>");


    $isActive = new input("rovnouplat$i", 0, "Přidat rovnou plat č.$i");
    $isActive->option("Ano", "Ne");
    $form->add($isActive);


    $name = new input("platname$i", "", "Poznamka");
    $name->text(0);
    $form->add($name);


    $roky = array();
    $rok = date("Y");
    while ($rok > 1999) {
        $roky[$rok] = $rok;
        $rok--;
    }
    $name = new input("platrok$i", "", "Rok");
    $name->select($roky);
    $form->add($name);


    $name = new input("platplat$i", "", "Plat");
    $name->text();
    $form->add($name);

    $name = new input("platodmeny$i", "", "Odměny / náhrady");
    $name->text();
    $form->add($name);


    $name = new input("platbonus$i", "", "Bonus");
    $name->text();
    $form->add($name);

    $name = new input("platnefbonus$i", "", "Nefinanční bonus");
    $name->text();
    $form->add($name);

    $mesice = array();
    $mesic = 12;
    while ($mesic > 0) {
        $mesice[$mesic] = $mesic;
        $mesic--;
    }
    $name = new input("platpocetmes$i", "", "Počet měsíců");
    $name->select($mesice);
    $form->add($name);


    $isActive = new input("platisActive$i", 1, "Aktivní");
    $isActive->option("Ano", "Ne");
    $form->add($isActive);

    $i++;
}


    $form->add("<hr>");

*/

$form->plot();

 $save = new button('Uložit', 'labelSave', $id);
 $save->enterSubmit();
 echo $save->getString();

