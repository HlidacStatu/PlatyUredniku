<?php

// return current (user's) IP
function dejIP(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function ifUserLogged(){

    if (isset($_SESSION["loged"]) and ($_SESSION["loged"] == true) ){

        return true;
    }else{
        return false;
    }
}


function checkUserLogIn(){

    if (isset($_SESSION["loged"]) and ($_SESSION["loged"] == true) ){

    }else{
        header("Location: /");
        die;
    }
}

function checkUserAdmin(){

    if (isset($_SESSION["loged"]) and ($_SESSION["isAdmin"] == 1) ){

    }else{
        header("Location: /admin/");
        die;
    }
}


function dateformat($date, $format = "j.n.Y"){
    return date($format, strtotime($date));
}


function datetimeformat($date, $format = "j.n.Y H:i"){
    return date($format, strtotime($date));
}


function dateauto($date){

    if(date("Y", strtotime($date)) == date("Y")){
        $format = "j.n.";
    }else{
        $format = "j.n.Y";
    }

    return date($format, strtotime($date));
}


function mesicCesky($mesic, $up = false) {
    if ($up == true){
        $nazvy = array(1 => 'Leden', 'Únor', 'Březen', 'Duben', 'Květen', 'Červen', 'Červenec', 'Srpen', 'Září', 'Říjen', 'Listopad', 'Prosinec');
    }else{
        $nazvy = array(1 => 'leden', 'únor', 'březen', 'duben', 'květen', 'červen', 'červenec', 'srpen', 'září', 'říjen', 'listopad', 'prosinec');
    }
    return $nazvy[$mesic];
}

function mesicRew($mesic) {
    static $nazvy = array(1 => 'leden', 'unor', 'brezen', 'duben', 'kveten', 'cerven', 'cervenec', 'srpen', 'zari', 'rijen', 'listopad', 'prosinec');
    return $nazvy[$mesic];
}

function denCesky($mesic) {
    $nazvy = array(0 => 'Neděle', 'Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek', 'Sobota');

    return $nazvy[$mesic];
}


function mesicRew2num($mesic) {
    $nazvy["leden"] = 1;
    $nazvy["unor"] = 2;
    $nazvy["brezen"] = 3;
    $nazvy["duben"] = 4;
    $nazvy["kveten"] = 5;
    $nazvy["cerven"] = 6;
    $nazvy["cervenec"] = 7;
    $nazvy["srpen"] = 8;
    $nazvy["zari"] = 9;
    $nazvy["rijen"] = 10;
    $nazvy["listopad"] = 11;
    $nazvy["prosinec"] = 12;
    return $nazvy[$mesic];
}

//array vard dump with pre's
function echo_array($arr){
    echo "<pre>";
    var_dump($arr);
    echo "</pre>";
}

function valid($in){
    if(!is_string($in)){return ""; }
    global $link;
    return trim(htmlspecialchars(mysqli_real_escape_string($link, $in)));
}

function selfDomain(){
    return str_replace("www.", "", $_SERVER['SERVER_NAME']);
}

function selfURL($vcetneProtokolu = "ano"){
    $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
    $protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
    $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
    $protocol = $protocol."://";
    if ($vcetneProtokolu == "ne"){
        $protocol = "";
    }
    return $protocol.$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
}

function strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2)); }

function photo($src, $variant = "", $default = "/admin/img/photo.png"){

    if ($variant != ""){
        $variant = $variant."-";
    }
    if ($src == ""){
        $src =$default;
    }else{
        if (strtolower(substr($src, -3, 3)) == "jpg" && strtolower(substr($src, 0, 7)) == "/files/" ){
            $src = str_replace("/files/", "/files/$variant", $src);
        }
    }
    return $src;
}

function fileextension($src){
    $extension = "";
    $temp = explode(".", $src);
    $extension = strtolower(end($temp));
    return $extension;
}
function iconFile($src, $size = "medium", $def =  "img/no.png"){

    if(empty($src)){
        return $def;
        die;
    }

    $extension = "";
    $temp = explode(".", $src);
    $extension = strtolower(end($temp));

    $fotoExts = array("gif", "jpeg", "jpg", "png");
    if (in_array($extension, $fotoExts)){
        $link =  photo($src, $size, $def);
    }else{
        $link =  "img/no.png";
    }
    //    povoleno: "gif", "jpeg", "jpg", "png", "pdf", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "zip", "rar", "exe"
    if (strtolower($extension) == "pdf") {$link =  "img/pdf.png";		}
    if (strtolower($extension) == "doc") {$link =  "img/word.png";		}
    if (strtolower($extension) == "docx") {$link =  "img/word.png";		}
    if (strtolower($extension) == "xls") {$link =  "img/excel.png";		}
    if (strtolower($extension) == "xlsx") {$link =  "img/excel.png";		}
    if (strtolower($extension) == "ppt") {$link =  "img/powerpoint.png";		}
    if (strtolower($extension) == "pptx") {$link =  "img/powerpoint.png";		}
    if (strtolower($extension) == "zip") {$link =  "img/zip.png";		}
    if (strtolower($extension) == "rar") {$link =  "img/zip.png";		}
    if (strtolower($extension) == "exe") {$link =  "img/admin.png";		}

    return $link;
}

function photoData($id){
    $id = intval($id);
    $query = "SELECT * FROM tbFiles WHERE id = $id";

    $data = new sql($query);
    //$out = "";
    $data = $data->first();

        $array = json_decode($data["exif"], true);

    $out["aperture"] = $array["COMPUTED"]["ApertureFNumber"];
    $out["exposure"] = $array["ExposureTime"];
    $out["device"] = $array["Model"];
    $out["focal"] = $array["FocalLength"];
    $out["iso"] = $array["ISOSpeedRatings"];
    $out["exposure"] = $array["ExposureTime"];
    $out["date"] = $array["DateTimeOriginal"];

    return $out;
}


function ts($in){
    if ($_SESSION["lang"] == 1){
        return $in;
    }
    $translate = new Translator($_SESSION["lang"]);
    return $translate->__($in);
}


function fly($to, $subject, $text, $mail = ""){
    global $rocket;
    if(empty($mail)){
        $mail = $rocket["mail"];
    }


    ob_start();
    require dirname(__FILE__) . '/mail.php';
    $mess = ob_get_clean();



    $head  = 'From: '.$mail."\n";
    $head .= "MIME-Version: 1.0\n";
    $head .= "X-Mailer: PHP\n";
    $head .= "X-Priority: 3\n"; // priorita (1 nejvyšší, 2 velká, 3 normální ,4 nejmenší)
    $head .= 'Return-Path: <'.$mail.'>'."\n";
    $head .= "Content-Type: text/html; charset=UTF-8\r\n";


    $mail = @mail($to, $subject, $mess, $head);

    return "ok";
}




function continueTo($page){
    //back page after save
    global $module;
    global $target;
    global $source;
    global $user;
    echo mess::show();
    echo "<script> buildAdminUrl('$module', '$page', '$target', '$source'); </script>";
    require_once dirname(__FILE__).'/../modules/'.$module.'/'.$page.'.php';

}

function dejAnoNe($val){
    if ($val == 1){
        return "Ano";
    }else{
        return "Ne";
    }
}

function dejAnoNe2($val, $val2){
    if ($val == 1){
        return "Ano, $val2";
    }else{
        return "Ne";
    }
}


function strong($val){
    return "<strong>$val</strong>";
}


function clickableLink($link){
    $url = $link;
    $prefixes = array('/', 'http://', 'https://');
    $gotPrefix = false;
    foreach($prefixes as $prefix) {
        if(substr($url, 0, strlen($prefix)) == $prefix) {
            $gotPrefix = true;
            break;
        }
    }
    if(!$gotPrefix)
        $url = 'http://' . $url;

    return $url;
}


function saveLabel($table, $arr, $material){


    if(!is_array($arr)){
        $arr = explode(";",$arr);
    }


//var_dump($arr);


    $query = "DELETE FROM $table WHERE source = $material";
    new sql($query);
    foreach ($arr as $key => $val) {

        if(!empty($val)) {
            $query = "delete from $table where source = '$material' and label = '$val' ";
            new sql($query);

            $query = "INSERT INTO $table SET source = '$material', label = '$val' ";

        //    echo $query . "<br>";
            new sql($query);
        }
    }
}

function getSelectedLabels($table, $id){




    if(empty($id)){
        return false;
    }
    $query = "SELECT * FROM $table where source = $id";
    $tmp = new sql($query);
    $out = array();
    foreach ($tmp->all() as $label){
        $out[] = $label["label"];
    }
    return implode(";", $out);
}

function plotLabels($labels, $selected){
    $values = explode(";", $selected);
    $out = "";

    foreach($labels as $key => $val){
        if (in_array($key, $values)){
            $out .= '<div class="tag a labelTag" data="'.$key.'">'.$val.'</div>';
        }
    }
    return $out;
}


function plotTextLabels($labels, $selected){
    $values = explode(",", $selected);
    $out = array();

    foreach($labels as $key => $val){
        if (in_array($key, $values)){
            $out[] = $val;
        }
    }
    return implode(", ",$out);
}



function shortText($text, $lenght){


    $text = strip_tags($text);
    
    if(strlen($text) < $lenght){
        return $text;
    }

    return mb_substr(strip_tags($text),0, $lenght, "utf-8");


}


function DMStoDEC($deg,$min,$sec)
{

// Converts DMS ( Degrees / minutes / seconds )
// to decimal format longitude / latitude

    return $deg+((($min*60)+($sec))/3600);
}

function DECtoDMS($dec)
{

// Converts decimal longitude / latitude to DMS
// ( Degrees / minutes / seconds )

// This is the piece of code which may appear to
// be inefficient, but to avoid issues with floating
// point math we extract the integer part and the float
// part by using a string function.

    $vars = explode(".",$dec);
    $deg = $vars[0];
    $tempma = "0.".$vars[1];

    $tempma = $tempma * 3600;
    $min = floor($tempma / 60);
    $sec = $tempma - ($min*60);
    $sec = floor($sec);
    return "{$deg}°{$min}'{$sec}\"";
}


function usertype($type){
return true;
}


function getweather(){

    require dirname(__FILE__) . "/../../cron/_weathercache.php";


    $tmp = json_decode($weather, true);

    $tmp["mesto"]["cameranow"] = round($cameraweather);
    return $tmp["mesto"];
}

function langshort(){

       if(selfDomain() == "harrachov.com"){

           if($_SESSION["lang"] != 2 && $_SESSION["langName"] != $langName){
               return "/".$_SESSION["langName"];
           }else {
               return "";
           }


       }else {


           if($_SESSION["lang"] != 1 && $_SESSION["langName"] != $langName){
               return "/".$_SESSION["langName"];
           }else {
               return "";
           }

       }

}

function getweathericon($name){

    $tmp =  array(
        "zatazeno" => "w06", //Zataženo
        "skorojasno" => "w02", //	Skoro jasno
        "polojasno" => "w03", //	Polojasno
        "dest" => "w10", //	Oblačno až zataženo s trvalým deštěm
        "prehanky-bourky" => "w09", //	Polojasno až oblačno s přeháňkami nebo bouřkami
        "-" => "w20", //	Polojasno až oblačno s přeháňkami nebo bouřkami
        "prehanky-snih-dest" => "w14", //	Polojasno až oblačno se smíšenými přeháňkami
        "snih" => "w13", //	Oblačno až zataženo se sněžením
        "obcasny-dest" => "w07", //	Oblačno až zataženo s občasným deštěm
        "oblacno" => "w06", //	Oblačno
        "bourky" => "w08", //	Oblačno až zataženo s bouřkami
        "jasno" => "w01", //	Jasno
        "prehanky-snih" => "w19", //	Polojasno až oblačno se sněhovými přeháňkami
        "mlha" => "w16", //	Mlha, zataženo nízkou oblačností
        "snih-dest" => "w10", //	Oblačno až zataženo s deštěm se sněhem
        "prehanky-dest" => "w04", //	Polojasno až oblačno s dešťovými přeháňkami
        "skorojasno-bourky" => "w21", //	Skoro jasno až polojasno s možností bouřky
        "skorojasno-prehanky" => "w04", //	Skoro jasno až polojasno s možností přeháňky
        "kroupy" => "w11" //	Polojasno až oblačno s bouřkami doprovázené kroupami
    );
    return $tmp[$name];
}

function getweathertitle($name){

    $tmp =  array(
        "zatazeno" => "Zataženo",
        "skorojasno" => "Skoro jasno",
        "polojasno" => "Polojasno",
        "dest" => "Oblačno až zataženo s trvalým deštěm",
        "prehanky-bourky" => "Polojasno až oblačno s přeháňkami nebo bouřkami",
        "prehanky-snih-dest" => "Polojasno až oblačno se smíšenými přeháňkami",
        "snih" => "Oblačno až zataženo se sněžením",
        "obcasny-dest" => "Oblačno až zataženo s občasným deštěm",
        "oblacno" => "Oblačno",
        "bourky" => "Oblačno až zataženo s bouřkami",
        "jasno" => "Jasno",
        "prehanky-snih" => "Polojasno až oblačno se sněhovými přeháňkami",
        "mlha" => "Mlha, zataženo nízkou oblačností",
        "snih-dest" => "Oblačno až zataženo s deštěm se sněhem",
        "prehanky-dest" => "Polojasno až oblačno s dešťovými přeháňkami",
        "skorojasno-bourky" => "Skoro jasno až polojasno s možností bouřky",
        "skorojasno-prehanky" => "Skoro jasno až polojasno s možností přeháňky",
        "kroupy" => "Polojasno až oblačno s bouřkami doprovázené kroupami"
    );
    return $tmp[$name];
}

function dejStatyList(){
    $arr = array(

        "Česká republika	",
        "--------------	",
        "Afgánistán	",
        "Albánie	",
        "Alžírsko	",
        "Andorra	",
        "Angola	",
        "Antigua a Barbuda 	",
        "Argentina	",
        "Arménie	",
        "Austrálie	",
        "Ázerbardžán	",
        "Bahamy	",
        "Bahrajn	",
        "Bangladéš	",
        "Barbados	",
        "Belgie	",
        "Belize	",
        "Bělorusko	",
        "Benin	",
        "Bhútán	",
        "Bolívie	",
        "Bosna a Hercegovina	",
        "Botswana	",
        "Brazílie	",
        "Brunej	",
        "Bulharsko	",
        "Burkina Faso	",
        "Burundi	",
        "Côte d'Ivoire (Pobřeží slonoviny)	",
        "Čad	",
        "Čína	",
        "Dánsko	",
        "Dominika	",
        "Dominikánská republika	",
        "Džibutsko	",
        "Egypt	",
        "Ekvádor	",
        "Eritrea	",
        "Estonsko	",
        "Etiopie	",
        "Fidži	",
        "Filipíny	",
        "Finsko	",
        "Francie	",
        "Gabon	",
        "Gambie	",
        "Ghana	",
        "Grenada	",
        "Gruzie	",
        "Guatemala	",
        "Guinea	",
        "Guinea-Bissau	",
        "Guyana	",
        "Haiti	",
        "Honduras	",
        "Chile	",
        "Chorvatsko	",
        "Indie	",
        "Indonésie	",
        "Irák	",
        "Irán	",
        "Irsko	",
        "Island	",
        "Itálie	",
        "Izrael	",
        "Jamajka	",
        "Japonsko	",
        "Jemen	",
        "Jižní Afrika	",
        "Jordánsko	",
        "Kambodža	",
        "Kamerun	",
        "Kanada	",
        "Kapverdy	",
        "Katar	",
        "Kazachstán	",
        "Keňa	",
        "Kiribati	",
        "KLDR	",
        "Kolumbie	",
        "Komory	",
        "Konžská demokratická republika	",
        "Konžská republika	",
        "Korejská republika	",
        "Kostarika	",
        "Kuba	",
        "Kuvajt	",
        "Kypr	",
        "Kyrgyzstán	",
        "Laos	",
        "Lesotho	",
        "Libanon	",
        "Libérie	",
        "Libye	",
        "Lichtenštejnsko	",
        "Litva	",
        "Lotyšsko	",
        "Lucembursko	",
        "Madagaskar	",
        "Maďarsko	",
        "Makedonie	",
        "Malajsie	",
        "Malawi	",
        "Maledivy	",
        "Mali	",
        "Malta	",
        "Maroko	",
        "Marshallovy ostrovy	",
        "Mauricius	",
        "Mauritánie	",
        "Mexiko	",
        "Mikronésie	",
        "Moldavsko	",
        "Monako	",
        "Mongolsko	",
        "Mosambik	",
        "Myanmar (Barma)	",
        "Namibie	",
        "Nauru	",
        "Německo	",
        "Nepál	",
        "Niger	",
        "Nigérie	",
        "Nikaragua	",
        "Nizozemsko	",
        "Norsko	",
        "Nový Zéland	",
        "Omán	",
        "Pákistán	",
        "Palau	",
        "Panama	",
        "Papua-Nová Guinea	",
        "Paraguay	",
        "Peru	",
        "Polsko	",
        "Portugalsko	",
        "Rakousko	",
        "Rovníková Guinea	",
        "Rumunsko	",
        "Rusko	",
        "Rwanda	",
        "Řecko	",
        "Salvador	",
        "Samoa	",
        "San Marino	",
        "Saudská Arábie	",
        "Senegal	",
        "Seychely	",
        "Sierra Leone	",
        "Singapur	",
        "Slovensko	",
        "Slovinsko	",
        "Somálsko	",
        "Spojené arabské emiráty	",
        "Spojené království	",
        "Spojené státy americké	",
        "Srbsko a Černá Hora	",
        "Srí Lanka	",
        "Středoafrická republika	",
        "Súdán	",
        "Surinam	",
        "Svatá Lucie	",
        "Svatý Kryštof a Nevis	",
        "Svatý Tomáš a Princův ostrov	",
        "Svatý Vincent a Grenadiny	",
        "Svazijsko	",
        "Sýrie	",
        "Šalamounovy ostrovy	",
        "Španělsko	",
        "Švédsko	",
        "Švýcarsko	",
        "Tádžikistán	",
        "Taiwan	",
        "Tanzanie	",
        "Thajsko	",
        "Togo	",
        "Tonga	",
        "Trinidad a Tobago	",
        "Tunisko	",
        "Turecko	",
        "Turkmenistán	",
        "Tuvalu	",
        "Uganda	",
        "Ukrajina	",
        "Uruguay	",
        "Uzbekistán	",
        "Vanatu	",
        "Vatikán	",
        "Venezuela	",
        "Vietnam	",
        "Východní Timor	",
        "Zambie	",
        "Zimbabwe	"
    );
    $outarr = array();
    foreach ($arr as $stat){
        $outarr[trim($stat)] = trim($stat);
    }
    return $outarr;
}
