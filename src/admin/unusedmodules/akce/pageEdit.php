<?php 

$page = new page("Editace akce");
	
$back = new button('<i class="fa fa-arrow-left"></i> Zpět', 'index', $id);
$back->returnBack();
echo $back->getString();

$page->title();

$data["isDo"] = 0;
$data["autor"] = $user["name"];
$galleryID = 0;
if ($target!="-"){
     $data = akce::dejData($target);
     $galleryID = $target;
}


$form = new form();


/*
$tabs = new tabControl("4title", "small");
foreach (lang::dejArray() as $lang){
    $tabs->addTab($lang["name"], "title-".$lang["short"]);
}
$tabs->plotThere();
*/

$minimum = 4;
foreach (lang::dejArray() as $lang){
  //  $tab = new tab("title-".$lang["short"], "4title");
    $name = new input("langtitle".$lang["id"], $data, "Název v ".$lang["short"]);
    $name->text($minimum);
    $minimum = 0;
    $form->add($name);


    $input = new input("langperex".$lang["id"], $data, "Perex v ".$lang["short"]);
    $input->editor();
    $form->add($input);

    $input = new input("langtext".$lang["id"], $data, "Text v ".$lang["short"]);
    $input->editor();
    $form->add($input);
  //  $tab->contentEnd();
}


$name = new input("photo", $data, "Fotografie");
$name->image();
$form->add($name);


$name = new input("datum", $data, "Datum konání");
$name->date();
$name->help("V tento datum se zobrazí v kalendáři");
$form->add($name);


$input = new input("isDo", $data, "Více denní akce");
$input->option("Ano", "Ne");
$form->add($input);

$tmp = "style='opacity: 1'";
if($data["isDo"] == 0){
    $tmp = "style='opacity: 0.3'";
}
$form->add("<div class='clear'></div><div class='datumDoOption a' $tmp>");

$name = new input("datumDo", $data, "Datum do");
$name->date();
$form->add($name);

$form->add("</div>");


$name = new input("misto", $data, "Místo konání akce");
$name->text();
$form->add($name);



$name = new input("lat", $data, "Lat");
$name->text();
$form->add($name);
$name = new input("lng", $data, "Lng");
$name->text();
$form->add($name);

?>
<div class="clickmapplace">
    <div id="clickmap" style="width: 514px; height: 240px;"></div>
    <div class="btn a blue" id="findbygps">Použít tyto souřadnice</div><div class="info"></div>
    <script>  setTimeout(function () {initMap();  console.log("fdfs");}, 1000) </script>
    <div class="clear"></div>
</div>
<div class="clear"></div>
<?



$page->subtitle("Fotogalerie");
$page->breakPage();
?><div class="clear"></div><br><br><?

$multifiles = new multiFiles("Fotografie", "photoOne", $galleryID);


$photoOrder = new sortableSpace("files", "photoOrder", $multifiles);
echo akce::dejPhotoList($galleryID);
$photoOrder->plotThere();




$form->plot();

 $save = new button('Uložit', 'pageSave', $id);
 $save->enterSubmit();
 echo $save->getString();

?>
<script>
    $(".datumDoOption").unbind();
    $("#isDo").change(function () {
        if($("#isDo").val() === "1"){
            $(".datumDoOption").css("opacity", "1");
        }else{
            $(".datumDoOption").css("opacity", "0.3");
        }
    });


</script>
