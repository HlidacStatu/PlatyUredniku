<?php    


if ($accept){     // nejdříve dotaz

$data = platy::dejData($target);
    
$page = new page($data["name"]);

$page->circle($data["photo"], "img/tag.png");
$page->title();
$page->text("Opravdu chcete smazat tento plat?");


$no = new button('<i class="fa fa-times"></i> Ne', '', $target, "storno", "red");
$yes = new button('<i class="fa fa-check"></i></i> Ano', 'platDel', $target, "page");
$yes->addSource($source);


echo $no->getString();
echo $yes->getString();



}else{
    
    
      $query = "UPDATE tbPlaty SET
                   isDel = 1
                   WHERE id = $target";


new sql($query);

   
mess::create("green", "Plat byl smazán");
$return = true;

$target = $source;
continueTo("labelPlaty");
} 
