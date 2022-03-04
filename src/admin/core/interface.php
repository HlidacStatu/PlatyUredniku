<?php
// menu
class menu {
    protected $menu = array();
    protected $menu2 = array();

    public function __construct(){
	$i = 0;
	while($i <25){
	    $this->menu[$i] = "";
	    $i++;
	}
	$i = 0;
	while($i <25){
	    $this->menu2[$i] = "";
	    $i++;
	}
    }

    public function addTop($moduleFolder, $moduleName, $order = 25){
	while(!empty($this->menu["$order"])){
	    $order++;
	}
    $tmpArr = array("folder" => $moduleFolder, "name" => $moduleName);

	$this->menu[$order] = $tmpArr;
    }
    public function addBottom($moduleFolder, $moduleName, $order = 25){
	while(!empty($this->menu2["$order"])){
	    $order++;
	}
        $tmpArr = array("folder" => $moduleFolder, "name" => $moduleName);

        $this->menu2[$order] = $tmpArr;
    }

    public function plot(){




	foreach($this->menu as $module){
	    if ($module != ""){

	    echo ' <div class="mainBtn a" module="'.$module["folder"].'" data="">'.$module["name"].'</div>
	    ';
	    }
	}
    }
    public function plotBottom(){
	foreach($this->menu2 as $module){
	    if ($module != ""){
	    echo ' <div class="mainBtn a" module="'.$module["folder"].'" data="">'.$module["name"].'</div>
	    ';
	    }
	}
    }
}




//page
class page{
    protected $pageName;
    protected $modul;

    public function __construct($name = ""){
	$this->pageName = $name;
    }

    public function title($name = NULL){
	if ($name != NULL){
	    $this->pageName = $name;
	}
	echo "<h1>{$this->pageName}</h1>";
    }
    public function breakPage($return = false){
        if($return) {
            return "<div class=clear></div>";
        }
        echo "<div class=clear></div>";
    }
    public function subtitle($text, $return = false){
        if($return){
            return "<div class=clear></div><h2>$text</h2><div class=clear></div>";
        }
        echo "<h2>$text</h2>";
    }
    public function text($text){
	echo "<p>$text</p>";
    }
    public function topPhoto($photo, $default="none"){
	if ($photo == "" && $default = "none"){
	    echo "";
	    return false;
	}
	$url = photo($photo, "big", $default);
	echo "<div class=topPhoto style='background-image: url(\"$url\")'></div>";
    }

    public function circle($url, $default){
	$url = photo($url, "medium", $default);
	echo "<div class=circle style='background-image: url(\"$url\")'></div>";
    }

    public function homeCircle($url, $default){
	$url = photo($url, "medium", $default);
	echo "<div class=homeCircle style='background-image: url(\"$url\")'></div>";
    }
}


// one line (for data list or photo list)
class line{
    protected $icon;
    protected $name;
    protected $id = 0;
    protected $notes = "";
    protected $infos = "";
    protected $buttons = "";
    protected $dragable = false;
    protected $bog = false;

    public function __construct($name, $id = 0){
	$this->name = $name;
	$this->id = $id;
    }
    public function addIcon($icon, $default, $size = "", $color = ""){
	if ($color != ""){
	    $color = " background-color: $color;";
	}
	$this->icon = ' <div class="icon" style="background-image: url('.photo($icon, "small", $default).'); '.$color.'">';
    }
    public function dragable(){
	$this->dragable = true;
    }
    public function big(){
	$this->big = true;
    }
    public function addButton($button){
	$this->buttons .= $button;
    }
    public function langButtons($page, $id = ""){
	if($id != ""){ $this->id = $id; }
	//$this->buttons .= lang::buttons($this->id, $page);
    }
    public function addNote($string){
	$this->notes .= '<div class="notes">'.$string.'</div>';
    }
    public function addPerents($percents1, $percents2){
	$this->notes = "<div class=percentLine><div class=percentIn style='width: $percents1'></div>  <div class=info>$percents2</div></div>".$this->notes;
    }
    public function getString(){
	$big = "";
	if ($this->big){ $big = " photoBig "; }
	if ($this->dragable){ $this->icon .= '   <div class="drag a"></div> '; $big .= " dragableLine "; }else{
        $this->icon = "  <div class=\"datalineclick\" onclick=\"lineclick(this, $(this)); \"> {$this->icon} </div>";
    }
	if ($this->icon != ""){ $this->icon .= "</div>"; }
	return '<div class="dataLine '.$big.' a" id="item-'.$this->id.'">
                   '.$this->icon.'
                    <div class="data datalineclick" onclick="lineclick(this, $(this)); ">
                        <div class="name">'.$this->name.'</div>
			'.$this->notes.'
                    </div>
                    <div class="btns">
                        '.$this->buttons.'
                    </div>
                    <div class="clear"></div>
                </div>';
    }
}


class linebox{
    protected $icon;
    protected $name;
    protected $id = 0;
    protected $notes = "";
    protected $infos = "";
    protected $buttons = "";
    protected $dragable = false;
    protected $bog = false;

    public function __construct($name, $id = 0){
        $this->name = $name;
        $this->id = $id;
    }
    public function addIcon($icon, $default, $size = "", $color = ""){
        if ($color != ""){
            $color = " background-color: $color;";
        }
        $this->icon = ' <div class="icon" style="background-image: url('.photo($icon, "small", $default).'); '.$color.'">';
    }
    public function dragable(){
        $this->dragable = true;
    }
    public function big(){
        $this->big = true;
    }
    public function addButton($button){
        $this->buttons .= $button;
    }
    public function langButtons($page, $id = ""){
        if($id != ""){ $this->id = $id; }
        //$this->buttons .= lang::buttons($this->id, $page);
    }
    public function addNote($string){
        $this->notes .= '<div class="notes">'.$string.'</div>';
    }
    public function addPerents($percents1, $percents2){
        $this->notes = "<div class=percentLine><div class=percentIn style='width: $percents1'></div>  <div class=info>$percents2</div></div>".$this->notes;
    }
    public function getString(){
        $big = "";
        if ($this->big){ $big = " photoBig "; }
        if ($this->dragable){ $this->icon .= '   <div class="drag a"></div> '; $big .= " dragableLine "; }
        if ($this->icon != ""){ $this->icon .= "</div>"; }
        return '<div class="dataLine dataLineBox '.$big.' a" id="item-'.$this->id.'">
                   '.$this->icon.'
                    <div class="data datalineclick" onclick="lineclick(this, $(this)); ">
                        <div class="name">'.$this->name.'</div>
			'.$this->notes.'
                    </div>
                    <div class="btns">
                        '.$this->buttons.'
                    </div>
                    <div class="clear"></div>
                </div>';
    }
}


class button{
    protected $page;
    protected $source = "";
    protected $target;
    protected $do = "page";
    protected $color = "";
    protected $default = "";
    protected $ownClass = "";
    protected $title = "";

    public function __construct($text, $page, $target, $do = "page", $color = "", $ownClass = ""){
	$this->text = $text;
	$this->page = $page;
	$this->target = $target;
	$this->do = $do;
	$this->color = $color;
	$this->ownClass = $ownClass;
	if($do == "page"){
        $this->ownClass .= " btntrigger";
    }
    }
    public function enterSubmit(){
	$this->default = " enterSubmit ";
    }
    public function returnBack(){
	$this->default = " returnBack ";
    }
    public function addSource($source){
	$this->source = $source;
    }
    public function addTitle($title){
        $this->title = $title;
    }
    public function getString(){
	return ' <div onclick="btnPress($(this));" class="btn a '.$this->color.'  '.$this->default.' '.$this->ownClass.'" page="'.$this->page.'" title="'.$this->title.'"  do="'.$this->do.'" source="'.$this->source.'" target="'.$this->target.'">'.$this->text.'</div>';
    }
}


class previewTable {
    protected $html;
    public function __construct (){
	$this->html = '<div class="detailTable">';
    }
    public function one($label, $value){
	$this->html .= ' <div class="line one">
	    <div class="label">
		'.$label.':
	    </div>
	    <div class="data">
		'.$value.'
	    </div>
	   
	</div>';
    }
    public function two($label, $value, $label2, $value2){
	$this->html .= ' <div class="line two">
	    <div class="label">
		'.$label.':
	    </div>
	    <div class="data">
		'.$value.'
	    </div>
	    <div class="label">
		'.$label2.':
	    </div>
	    <div class="data">
		'.$value2.'
	    </div>
	</div>';
    }
    public function plot(){
	$this->html .= ' <div class="line"></div>
			</div>';
	echo $this->html;
    }
}


//záložky pro výpis náhledu
class tabControl{
    protected $out = "";
    protected $first = "";
    protected $remembered = "";
    protected $class = "";
    public function __construct($name = "tabs", $type = ""){

        global $module;
        $this->name = $name;
        $this->class = $type;
        if (isset($_SESSION["tabControlLast"]["{$module}tabs{$this->name}"])){
            $this->remembered = $_SESSION["tabControlLast"]["{$module}tabs{$this->name}"];
        }
            $this->out = '<div id="tabs'.$this->name.'" class="tabs '.$this->class.' ">';
    }
    public function addTab($label, $code){
	if ($this->first == ""){
	    $this->first = $code;
	}
	$this->out .= '<div class="tab a TABdef'.$code.'" data="TAB'.$code.'">
	'.$label.'
    </div>';
    }
    public function plotThere(){

	if ($this->remembered == ""){
	    $this->remembered = $this->first;
	}

	$this->out .= '</div>';
	echo $this->out;
	echo ' <script>   $("#tabs'.$this->name.' .tab").unbind();
    $("#tabs'.$this->name.' .tab").click(function(){
	$("#tabs'.$this->name.' .tab").removeClass("aktivni");
	$(this).addClass("aktivni");
	$(".tabBlok'.$this->name.'").removeClass("aktivni");
	$(".tabBlok'.$this->name.'."+$(this).attr("data")).addClass("aktivni");
	
	$.ajax({type: "POST",
	    url: "/admin/core/pager.php",
	    data: { module: module+"tabs'.$this->name.'", tabSet: $(this).attr("data"), tabControlSet:  true}
	});
    }); 
    $("#tabs'.$this->name.' .TABdef'.$this->remembered.'").trigger("click");
    </script>
    ';
    }
}
class tab{
    public function __construct($code = "", $type="tabs"){
	    echo '<div class="tabBlok TAB'.$code.' tabBlok'.$type.'">';
    }
    public function contentEnd(){
	echo "</div>";
    }
}

class multiFiles{
 protected $name = "";
 protected $label = "";
 protected $file = "";
 protected $source = "";
 protected $append = "";

    public function __construct($label, $name, $source){
        $this->name = $name;
        $this->label = $label;
        $this->file = $name;
        $this->source = $source;
    }
    public function appendTo($name){
        $this->append = $name;
    }
    public function plot(){
        $out = '<script>
                     $("#'.$this->name.'").unbind("focusout");
                </script>
                <div class="formline multiupload">
                        
                        <input type="file" class=fileClick id="fileClick'.$this->name.'" style="display:none" multiple accept="/*" onclick="">
                        <div class="nahled fileUpload a" onclick="$(this).parent().find(\'.fileClick\').trigger( \'click\' );" 
                        style="background-image: url(/admin/img/upload.png)">
                            <div class="notify a"></div>
                        </div>
                        <div class=input style="width: 800px; padding-top: 40px;">
                            <div class="imageBtn a fileNew" onclick="$(this).parent().parent().find(\'.fileClick\').trigger( \'click\' );" >Nahrát nové soubory</div>
                            <input type="hidden" class="return" name="'.$this->name.'" id="filereturn'.$this->name.'" value="" placeholder="test">     
                        <div class=help style="padding-top: 10px;">
                           Přetažením souboru na kolečko nebo kliknutím na tlačítko "Nahrát nový" můžete nahrát nový soubor</div>
                        </div>';
$out .= "
          <script>
                                    $('#{$this->name}').change(function(){
                                        $(this).parent().parent().find(\" .nahled\").css(\"background - image\",\"url(/admin/img/upload.png)\");
                                    });
                                    $('#fileClick{$this->name}').unbind();
                                    $('#fileClick{$this->name}').change(function(event){
                                        var files = event.target.files;
                                        handleFileUpload(files,$(this).parent());
                                    });
                                    $('#filereturn{$this->name}').unbind();
                                    $('#filereturn{$this->name}').change(function(event){
                                        $(this).parent().parent().find(\".nahled\").css('background-image','url(/admin/img/upload.png)');
                                          console.log($(this).val());
                                        $(\".preppendThere\").remove();
	$(\"#sortable$this->append\").prepend('<div class=\"preppendThere\"><img src=\"/admin/img/loader2.gif\"></div>');
        $.ajax({type: \"POST\",
		url: \"/admin/core/pager.php\",
		data: { module: module, page: '$this->file', source:  '$this->source', target: $(this).val()}
	}).done(function( data ) {
		$(\".preppendThere\").remove();
                $(\"#sortable$this->append\").prepend(data); 
                
                var data =  $( \"#sortable{$this->append}\" ).sortable('serialize');
        
         $(\".orderSaved{$this->append}\").clearQueue();
        $(\".orderSaved{$this->append}\").fadeIn();
        $(\".orderSaved{$this->append}\").delay(2500).fadeOut();
        
     
        $.ajax({type: \"POST\",
		url: \"/admin/core/pager.php\",
		data: { module: module, page: $( \"#sortable{$this->append}\" ).attr('url'), sort:  data}	});
			
	}); 
                                    });
                                    
                               </script>
";


        $out .= '
                        <div class="clear"></div>
               </div>
        ';

        return $out;
    }
}

class sortableSpace{

    protected $url = "";
    protected $name = "";
    public function __construct($name, $url, $multifiles = false){



        if($multifiles != false){
            $multifiles->appendTo($name);
            echo $multifiles->plot();
        }

	    $this->url = $url;
	    $this->name = $name;
	    echo ' <div id="orderSaved" class="orderSaved'.$name.'" style="display:none;">Nové pořadí bylo uloženo</div>
			    <div id="sortable'.$name.'" url="'.$url.'">';
    }
    public function plotThere(){
	echo '</div>';
	echo ' <script>   $(function() {
    $( "#sortable'.$this->name.'" ).sortable( {
    axis: \'y\',
    update: function (event, ui) {
        var data = $(this).sortable(\'serialize\');
        $(".orderSaved'.$this->name.'").clearQueue();
        $(".orderSaved'.$this->name.'").fadeIn();
        $(".orderSaved'.$this->name.'").delay(2500).fadeOut();
        // POST to server using $.post or $.ajax
        $.ajax({type: "POST",
		url: "/admin/core/pager.php",
		data: { module: module, page: "'.$this->url.'", sort:  data}
	});
    }
    });
    $( "#sortable" ).disableSelection();
  });
  </script>
    ';
    }
}

class sortableSpace2{

    protected $url = "";
    protected $name = "";
    public function __construct($name, $url, $multifiles = false){



        if($multifiles != false){
            $multifiles->appendTo($name);
            echo $multifiles->plot();
        }

        $this->url = $url;
        $this->name = $name;
        echo ' <div id="orderSaved" class="orderSaved'.$name.'" style="display:none;">Nové pořadí bylo uloženo</div>
			    <div id="sortable'.$name.'" url="'.$url.'">';
    }
    public function plotThere(){
        echo '</div>';
        echo ' <script>   $(function() {
    $( "#sortable'.$this->name.'" ).sortable( {
    update: function (event, ui) {
        var data = $(this).sortable(\'serialize\');
        $(".orderSaved'.$this->name.'").clearQueue();
        $(".orderSaved'.$this->name.'").fadeIn();
        $(".orderSaved'.$this->name.'").delay(2500).fadeOut();
        // POST to server using $.post or $.ajax
        $.ajax({type: "POST",
		url: "/admin/core/pager.php",
		data: { module: module, page: "'.$this->url.'", sort:  data}
	});
    }
    });
    $( "#sortable" ).disableSelection();
  });
  </script>
    ';
    }
}


//ajaxové stránkování
class listLoad{
    protected $pageName;
    protected $activeTag;
    protected $remembered = "";
    protected $search = "";
    protected $filter = "";
    protected $first = "";

    public function __construct($name){

        global $module;
        if (isset($_SESSION["labelControlLast"]["$module"])){
            $this->remembered = $_SESSION["labelControlLast"]["$module"];
            $this->search = $_SESSION["labelControlLastSearch"]["$module"];
            $this->filter = $_SESSION["labelControlLastFilter"]["$module"];
        }



	$this->pageName = $name;
    }

    public function addSort($arr){

        if($this->filter != "" && $this->remembered == "byfiltr"){
            $valset = $this->filter;
        }


        echo "<select id='filterselect' style='width: 200px; float:left; margin: 0 0px 0 0;'>";
        foreach ($arr as $key => $val){
            $tmp = "";
            if($key == $valset){
                $tmp = "selected";
            }
            echo "<option value='$key' $tmp>$val</option>";
        }

        echo "</select>";
        $this->addLabel("<i class='fa fa-filter'></i>", "byfiltr");

    }

    public function addLabel($name, $val){
        if ($this->first == ""){
            $this->first = $val;
        }
	    echo "<div class='tag a LABELdef$val' type='{$val}'>	{$name}   </div>";
    }
    public function addsSearchLabel ($placeholder = "", $val = ""){
        if($this->search != "" && $this->remembered == "search"){
            $val = $this->search;
        }
        echo " <input type='text' class='a' id='searchText' value='{$val}' placeholder='{$placeholder}' style='padding: 11px 10px;  float: left;  margin: 0 5px 0 0;  width: 160px;'>
        <div class='tag a LABELdefsearch' id=search type='search'>
        <i class='fa fa-search'></i>
        </div>";
    }
    public function loadThere(){

        if ($this->remembered == ""){
            $this->remembered = $this->first;
        }
	echo '
	  
	  <div class="clear"></div><br>
<div class="default">
<div class="preppendThere"></div>
</div>
<div class="loadMore a">Zobrazit další</div>
  
<script>
    var free = true;
    var pageNum = 1;
    $(".tag").unbind();
    $(".tag").click(function(){


console.log("1");
    $.ajax({type: "POST",
	    url: "/admin/core/pager.php",
	    data: { module: module, labelSet: $(this).attr("type"), searchSet: $("#searchText").val(), searchFilter: $("#filterselect").val(), labelControlSet:  true}
	});


console.log("2");
	pageNum = 1;
	type = $(this).attr("type");
	 $(".tag").removeClass("aktivni");
	 $(this).addClass("aktivni");
	$(".loadMore").trigger("click");
	$(".loadMore").html("Zobrazit další");
	$(".loadMore").removeClass("nonactive");

console.log("3");
    });


 $("#searchText").unbind();
    $("#searchText").keypress(function(e) {
    if(e.which == 13) {
       $("#search").trigger("click");
    }
});
    

    $( ".loadMore" ).unbind();
    $(".loadMore").click(function(){
	if (free === false) { return false; }
	free= false;
	if (pageNum === 1){
	    $(".default").html("");
	}
	$(".preppendThere").remove();
	$(".default").append(\'<div class="preppendThere"><img src="img/loader2.gif"></div>\');
	
	$.ajax({type: "POST",
		url: "/admin/core/pager.php",
		data: {  module: module, page: "'.$this->pageName.'",load: "true", type: type, pageNum: pageNum, search: $("#searchText").val(), filter: $("#filterselect").val() }
            }).done(function( data ) {
	    
		$(".preppendThere").remove();
		if (data === "[[END]]"){
		    $(".loadMore").html("To je vše");
		    $(".loadMore").addClass("nonactive");
		}else{
		$(".default").append(data);
		}
	    pageNum = pageNum + 1;
	    free=true;
	    });
	});

    
   $(".tag.LABELdef'.$this->remembered.'").trigger("click");

    
   
</script>

	';
    }
}



//ajaxové stránkování
class listLoad2{
    protected $pageName;
    protected $activeTag;
    protected $remembered = "";
    protected $search = "";
    protected $first = "";
    protected $startpage = 1;

    public function __construct($name){

        global $module;
        if (isset($_SESSION["labelControlLast"]["$module"])){
            $this->remembered = $_SESSION["labelControlLast"]["$module"];
            $this->search = $_SESSION["labelControlLastSearch"]["$module"];
        }

        $this->pageName = $name;
    }

    public function setStartPage($page = 1){
        $this->startpage = intval($page);
    }
    public function addLabel($name, $val){
        if ($this->first == ""){
            $this->first = $val;
        }
        echo "<div class='tag a LABELdef$val' type='{$val}'>	{$name}   </div>";
    }
    public function addSelect($val, $array){

        if($this->search != "" && $this->remembered == "search"){
            $val = $this->search;
        }

        echo " <select onchange='$(\".LABELdef$val\").addClass(\"autochange\");$(\".LABELdef$val\").trigger(\"click\");' type='text' class='a' id='serachFiltr$val' style='padding: 11px;  float: left;  margin: 0 5px 0 0;  width: 170px;'>";



        foreach ($array as $key => $option){

            $tmp = "";
            if($this->remembered == $val & $this->filtr == $key){
                $tmp = "selected";
            }

            echo "<option value='$key' $tmp>$option</option>";

        }



        echo "</select>
  <div class='tag tagfilter a LABELdef$val' type='{$val}'>	<i class='fa fa-filter'></i>  </div>
  ";
    }
    public function addSelect2($val, $array){

        if($this->search != "" && $this->remembered == "search2"){
            $val = $this->search;
        }

        echo " <select onchange='$(\".LABELdef2$val\").addClass(\"autochange\");$(\".LABELdef2$val\").trigger(\"click\");' type='text' class='a' id='serachFiltr2$val' style='padding: 11px;  float: left;  margin: 0 5px 0 0;  width: 170px;'>";



        foreach ($array as $key => $option){

            $tmp = "";
            if($this->remembered == $val & $this->filtr == $key){
                $tmp = "selected";
            }

            echo "<option value='$key' $tmp>$option</option>";

        }



        echo "</select>
  <div class='tag tagfilter2 a LABELdef2$val' type='{$val}'>	<i class='fa fa-filter'></i>  </div>
  ";
    }
    public function addsSearchLabel ($placeholder = "", $val = ""){
        if($this->search != "" && $this->remembered == "search"){
            $val = $this->search;
        }
        echo " <input type='text' class='a' id='searchText' value='{$val}' placeholder='{$placeholder}' style='padding: 11px 10px;  float: left;  margin: 0 5px 0 0;  width: 170px;'>
        <div class='tag a LABELdefsearch' id=search type='search'>
        <i class='fa fa-search'></i>
        </div>";
    }

    public function loadThere($sortableCallback = "")
    {

        if (!empty($sortableCallback)) {
            $this->sortablecallback = $sortableCallback;
        }

        $this->remembered = "";
        if ($this->remembered == "") {
            $this->remembered = $this->first;
        }
        echo '
	  
	  <div class="clear"></div><br>
	 <div id="orderSaved" class="orderSaved'.$this->sortablecallback.'" style="display:none;">Nové pořadí bylo uloženo</div>
			    <div id="sortable' . $this->sortablecallback . '" class="default">
<div class="preppendThere"></div>
</div>
<div class="loadMore withpager a">Zobrazit další</div>
  <div class="clear"></div>
<script>
    var free = true;
    var pageNum = '.$this->startpage.';
    var type = "";
    $(".tag").unbind();
    $(".tag").click(function(){


    $.ajax({type: "POST",
	    url: "/admin/core/pager.php",
	    data: { module: module,  page: "' . $this->pageName . '",  labelSet: $(this).attr("type"), searchSet: $("#searchText").val(), filtrSet: $("#serachFiltr"+$(".tagfilter.aktivni").attr("type")).val(), filtrSet2: $("#serachFiltr2"+$(".tagfilter2.aktivni").attr("type")).val(), labelControlSet:  true}
	});


	pageNum = 1;
	
	$(".listloadcount").remove();
	
	if($(this).attr("type") == "all"){
        type = $(this).attr("type");
         $(".tag").removeClass("aktivni");
         $(this).addClass("aktivni");
	
	}else{
	
	if( $(this).hasClass("autochange")){
        if( $(this).hasClass("aktivni")){
        
        }else{
         $(this).addClass("aktivni");
        }
	}else{
	
	if( $(this).hasClass("aktivni")){
	 $(this).removeClass("aktivni");
	}else{
	 $(this).addClass("aktivni");
	}
	
	 }
	 
	type = "";
	        $(".tag.aktivni").each(function(){
	        
	if($(this).attr("type") == "all"){
 $(this).removeClass("aktivni");
	
}else{
	                    if(type === ""){
	                      type = $(this).attr("type");
	                    
	                    }else{
	                    type = type+";"+$(this).attr("type");
	                      }
	              }
	        });
	        
	       
	       
	}
	
	
	$(".loadMore").trigger("click");
	$(".loadMore").html("Zobrazit další");
	$(".loadMore").removeClass("nonactive");

    });


 $("#searchText").unbind();
    $("#searchText").keypress(function(e) {
    if(e.which == 13) {
       $("#search").trigger("click");
    }
});
    

    $( ".loadMore" ).unbind();
    $(".loadMore").click(function(){
	if (free === false) { return false; }
	free= false;
	if (pageNum === 1){
	    $(".default").html("");
	}
	
	
	$(".preppendThere").remove();
	
	$(".default").append(\'<div class="preppendThere"><img src="img/loader2.gif"></div>\');
	
	$.ajax({type: "POST",
		url: "/admin/core/pager.php",
		data: {  module: module, page: "' . $this->pageName . '", target: "' . $this->target . '",  load: "true", type: type, pageNum: pageNum, search: $("#searchText").val(), filtr: $("#serachFiltr"+$(".tagfilter.aktivni").attr("type")).val(), filtrSet2: $("#serachFiltr2"+$(".tagfilter2.aktivni").attr("type")).val() }
            }).done(function( data ) {
            
          
	    
		$(".preppendThere").remove();
		if (data === "[[END]]"){
		if(pageNum == 1){
		$(".loadMore").html("To je vše");
		}else{
		$(".loadMore").html("To je vše");
		}
		    
		    $(".loadMore").addClass("nonactive");
		}else{
		 $(".navig").remove();
		$(".default").append(data);
		
            if(pageNum == parseInt($(".navig").attr("maxpage"))){
            	$(".loadMore").html("To je vše");
            	$(".loadMore").addClass("nonactive");
            }
            
	   
		
		$(".navig .loadpage").unbind();
		$(".navig .loadpage").click(function(){
		
		        pageNum = parseInt($(this).html());
		         $(".default").html("");
		        	$(".loadMore").trigger("click");
	$(".loadMore").html("Zobrazit další");
	$(".loadMore").removeClass("nonactive");
		});
		
		
	'; if($this->sortablecallback){
        echo '
		
		  $(function() {
    $( "#sortable' . $this->sortablecallback . '" ).sortable( {
    axis: \'y\',
    update: function (event, ui) {
        var data = $(this).sortable(\'serialize\');
        $(".orderSaved' . $this->sortablecallback . '").clearQueue();
        $(".orderSaved' . $this->sortablecallback . '").fadeIn();
        $(".orderSaved' . $this->sortablecallback . '").delay(2500).fadeOut();
        // POST to server using $.post or $.ajax
        $.ajax({type: "POST",
		url: "/admin/core/pager.php",
		data: { module: module, page: "' . $this->sortablecallback . '", sort:  data}
	});
    }
    });
    $( "#sortable" ).disableSelection();
  });';
    }
        echo '
  
		}
	    pageNum = pageNum + 1;
	    free=true;
	    });
	});

    
   $(".tag.LABELdef'.$this->remembered.'").trigger("click");

    
   
</script>

	';
    }

   public static function setCount($page, $numOnPage, $count){
        echo "<span class='listloadcount' style='display:none;'>$count</span>";

        $maxpage = ceil($count/$numOnPage);

        echo "<div class=\"navig\" maxpage='$maxpage'> <p><span>";



        if($page > 4){
            echo "   <a class='a loadpage'>1</a><a class='a loadpage'>2</a>";
        }elseif($page > 3){
            echo " <a class='a loadpage'>1</a>";
        }

        echo "</span><span>";

        if($page > 2){
            echo "<a class='a loadpage'>".($page-2)."</a><a class='a loadpage'>".($page-1)."</a>";
        }elseif($page > 1){
            echo "<a class='a loadpage'>".($page-1)."</a>";
        }

        echo "<strong>$page</strong>";


        if($page < $maxpage-1){
            echo "<a class='a loadpage'>".($page+1)."</a><a class='a loadpage'>".($page+2)."</a>";

        }elseif($page < $maxpage){
            echo "<a class='a loadpage'>".($page+1)."</a>";
        }
        echo "    </span><span>";

        if($page < $maxpage-3){
            echo " <a class='a loadpage'>".($maxpage-1)."</a><a class='a loadpage'>$maxpage</a>";

        }elseif($page < $maxpage-2){
            echo " <a class='a loadpage'>$maxpage</a>";


        }
        echo "
    </span>
</p>
</div><!-- /navig -->
     ";
    }
}
