<?php    


if ($accept){     // nejdříve dotaz

$data = instituce::dejData($target);
    
$page = new page($data["name"]);

$page->circle($data["photo"], "img/tag.png");
$page->title();
$page->text("Opravdu chcete smazat tuto instutuci?");


$no = new button('<i class="fa fa-times"></i> Ne', '', $target, "storno", "red");
$yes = new button('<i class="fa fa-check"></i></i> Ano', 'labelDel', $target, "page");


echo $no->getString();
echo $yes->getString();



}else{
    
    
      $query = "UPDATE tbInstituce SET
                   isDel = 1
                   WHERE id = $target";


new sql($query);

   
mess::create("green", "Instituce byla smazána");
$return = true;

continueTo("index");
} 
