<?php    


if ($accept){     // nejdříve dotaz

$data = platy::dejData($target);
    
$page = new page($data["name"]);

$page->circle($data["photo"], "img/tag.png");
$page->title();
$page->text("Opravdu chcete smazat tento plat?");


$no = new button('<i class="fa fa-times"></i> Ne', '', $target, "storno", "red");
$yes = new button('<i class="fa fa-check"></i></i> Ano', 'labelDel', $target, "page");


echo $no->getString();
echo $yes->getString();



}else{
    
    
      $query = "UPDATE tbPlaty SET
                   isDel = 1
                   WHERE id = $target";


new sql($query);

   
mess::create("green", "Plat byl smazán");
$return = true;

continueTo("index");
} 
