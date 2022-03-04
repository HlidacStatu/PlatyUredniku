<?php    


$data = aktuality::photoData($target);
    
$close = new button('<i class="fa fa-times"></i>', '', $target, "storno");
echo $close->getString();

$page = new page($data["name"]);

$page->circle($data["link"], "img/photo.png");





    $form = new form();


    $name = new input("note", $data, "Upravte poznámku k fotografii:");
    $name->textarea();
    $form->add($name);



    $form->plot();

    echo "<div onclick=\"galNote($(this));\" class=\"btn a photolinedel   \" page=\"photoDel\" title=\"\" do=\"storno\" source=\"1\" target=\"{$data["id"]}\"><i class=\"fa fa-check\"></i> Uložit</div>";


