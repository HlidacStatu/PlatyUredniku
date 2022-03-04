<?php 

$page = new page("Editace stránky");
	
$back = new button('<i class="fa fa-arrow-left"></i> Zpět', 'index', $id);
$back->returnBack();
echo $back->getString();

$page->title();

$data["isActive"] = 1;
$data["onHome"] = 0;

$galleryID = 0;
if ($target!="-"){
     $data = pages::dejData($target);
    $galleryID = $target;
}


$form = new form();





$name = new input("photo", $data, "Fotografie");
$name->image();
$form->add($name);


    // $tab = new tab("title-".$lang["short"], "4title");
    $name = new input("title", $data, "Název v ".$lang["short"]);
    $name->text(4);

    $form->add($name);





    $input = new input("text", $data, "Text v ".$lang["short"]);
    $input->editor();
    $form->add($input);
    //  $tab->contentEnd();







$isActive = new input("isActive", $data, "Aktivní");
$isActive->option("Ano", "Ne");
$form->add($isActive);






$form->plot();

 $save = new button('Uložit', 'pageSave', $id);
 $save->enterSubmit();
 echo $save->getString();

