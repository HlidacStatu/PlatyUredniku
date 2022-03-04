<?php
$page = new page("Homepage");
$page->title();





$page->breakPage();

$form = new form();

$data = homepagelang::dejData();

foreach (lang::dejArray() as $lang){
    // $tab = new tab("title-".$lang["short"], "4title");
    $name = new input("langtitle".$lang["id"], $data, "Název v ".$lang["short"]);
    $name->text($minimum);
    $minimum = 0;
  //  $form->add($name);


    $input = new input("langtext".$lang["id"], $data, "Text v ".$lang["short"]);
    $input->editor();
    $form->add($input);
    //  $tab->contentEnd();
}


$links = homepagelinks::dejData();

$page->subtitle("Odkaz 1");

$name = new input("linkname1", $links[1]["name"], "Text odkazu");
$name->text();
$form->add($name);

$name = new input("linkval1", $links[1]["val"], "Adresa odkazu");
$name->text();
$form->add($name);

$isActive = new input("isBlank1",  $links[1]["isBlank"], "Otevírat do nového okna");
$isActive->option("Ano", "Ne");
$form->add($isActive);


$page->subtitle("Odkaz 2");

$name = new input("linkname2", $links[2]["name"], "Text odkazu");
$name->text();
$form->add($name);

$name = new input("linkval2", $links[2]["val"], "Adresa odkazu");
$name->text();
$form->add($name);


$isActive = new input("isBlank2",  $links[2]["isBlank"], "Otevírat do nového okna");
$isActive->option("Ano", "Ne");
$form->add($isActive);



$form->plot();

$save = new button('Uložit', 'save', $id);
$save->enterSubmit();
echo $save->getString();

?>
