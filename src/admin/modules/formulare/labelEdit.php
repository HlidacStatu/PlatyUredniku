<?php

$back = new button('<i class="fa fa-times"></i>', 'index', $id, "storno");

echo $back->getString();



$page = new page("Odeslaný formulář");

$page->title();

$data["isActive"] = 1;
if ($target!="-"){
     $data = formulare::dejData($target);
}

?>

<div class="formdata">
<br>

<strong>Čas: </strong> <?=dateformat($data["date"],  "j.n.Y H:i");?><br>



    <?=$data["data"];?>

</div>

