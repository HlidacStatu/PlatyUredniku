<?php 

$page = new page("Editace jazykové mutace");
	
$back = new button('<i class="fa fa-arrow-left"></i> Zpět', 'index', $id);
$back->returnBack();
echo $back->getString();

$page->title();

$data["isActive"] = 1;
if ($target!="-"){
     $data = lang::dejData($target);
}


$form = new form();

$name = new input("name", $data, "Název");
$name->text(1);
$form->add($name);


$name = new input("short", $data, "Zkratka");
$name->help("Zadejte zktratku jazkové mutace, například 'CZ', 'ENG', atd.");
$name->text(1);
$form->add($name);




$name = new input("icon", $data, "Ikona");
$name->image();
$form->add($name);


    if ($id != 1){
        $isActive = new input("isActive", $data, "Aktivní");
        $isActive->option("Ano", "Ne");
        $form->add($isActive);

    }else{


        $name = new input("isActive", $data);
        $name->hidden();
        $form->add($name);

    }

 $page->subtitle("Slovník");
 
 if ($id != "-") {
     try{
$filename = dirname(__FILE__)."/$id.txt";
$handle = fopen($filename, "r");
$contents = fread($handle, filesize($filename));
fclose($handle);
     }catch (Exception $e) {
	 $contents = "";
     }
} 


$name = new input("file", $contents, "Překlady");
$name->help("Zapisujte formát ve tvaru: Originál=Překlad, jednotlivé fráze oddělujte novým řádkem");
$name->textarea("400px");
$form->add($name);


$save = new button('Uložit', 'langSave', $id);
$save->enterSubmit();
echo $save->getString();

$form->plot();

