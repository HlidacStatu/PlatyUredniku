<?php

/*
 * USER Control for TinyRocket 3.0
 * 
 * 
 */

// MAIN VAULES
$ModuleCode = "Settings CONTROLER 3.0";

// INTERFACE
$ModuleName = '<i class="fa fa-cog"></i> '."Nastavení";
$ModuleFolder = "settings";

if(usertype("admin")) {
    $menu->addBottom($ModuleFolder, $ModuleName, 6);
}
// CLASSES


function obdobi(){
    $data = new sql("select * from tbObdobi where isActive = 1");
    $data = $data->first();
    return $data["typ"];
}

function obdobiDruhe(){
    $data = new sql("select * from tbObdobi where isActive = 1");
    $data = $data->first();
    $obdobi = array("zima" => "leto", "leto" => "zima");
    return $obdobi[$data["typ"]];
}


function obdobiName($tmp){
    $obdobi = array("zima" => "Zima", "leto" => "Léto");
    return $obdobi[$tmp];
}

function obdobiIcon($tmp){
    $obdobi = array("zima" => "empire", "leto" => "sun-o");
    return $obdobi[$tmp];
}

function obdobiNameFalse($tmp){
    $obdobi = array("leto" => "Zima", "zima" => "Léto");
    return $obdobi[$tmp];
}
function obdobiIconFalse($tmp){
    $obdobi = array("leto" => "empire", "zima" => "sun-o");
    return $obdobi[$tmp];
}

function obdobiClass($tmp){
    $obdobi = array("zima" => "winter", "leto" => "summer");
    return $obdobi[$tmp];
}

function souradnice($typ){
    $data = new sql("select * from tbSouradnice where name = '$typ' ");
    $data = $data->first();
    return $data;
}

function nearest($lat, $lng, $typ = ""){
    if(empty($lat) || empty($lng)){
        return array();
    }

    if(!empty($typ)){
        $typ = " and name = '$typ'  ";
    }


    $query = "SELECT
                                                  *, (
                                                    6371 * acos (
                                                      cos ( radians($lat) )
                                                      * cos( radians( Lat ) )
                                                      * cos( radians( Lng ) - radians($lng) )
                                                      + sin ( radians($lat) )
                                                      * sin( radians( Lat ) )
                                                    )
                                                  ) AS distance
                                                FROM tbSouradnice
                                                where 1=1  $typ
                                                ORDER BY distance
                                                ";
    $data = new sql($query);
    return $data->all();
}


// TABLES
//   public function column($name, $type, $length = 11, $notNull = true, $default = false, $key = false, $autoIncrement = false, $fulltext = false){
$mainTable = new table("tbObdobi");
$mainTable->column("typ", "varchar", "11");
$mainTable->column("datum", "datetime");
$mainTable->column("isActive", "int", "2");


$mainTable = new table("tbSouradnice");
$mainTable->column("name", "varchar", "16");
$mainTable->column("lat", "varchar", "16");
$mainTable->column("lng", "varchar", "16");



$mainTable = new table("tbVleky");
$mainTable->column("name", "varchar", "50");



$mainTable = new table("tbSEO");
$mainTable->column("id", "int", "11", false, false, true, true, false);
$mainTable->column("name", "varchar", "300", true, false, false, false, true);
$mainTable->column("rew", "varchar", "500");

$langTable = new table("tbSEOLang");
$langTable->column("id", "int", "11", false, false, true, true, false);
$langTable->column("source", "int");
$langTable->column("lang", "int");
$langTable->column("name", "varchar", "300");
$langTable->column("text", "longtext");
$langTable->column("rew", "varchar", "500");



class seo
{


    static function dejData($id)
    {
        $id = intval($id);
        $query = "SELECT * FROM tbSEO WHERE id = '$id'";
        $data = new sql($query);

        $tmp = $data->first();


        $query = "SELECT * FROM tbSEOLang where source = {$tmp["id"]} ";
        $data = new sql($query);
        foreach ($data->all() as $zaznam) {
            $tmp["lang"]["{$zaznam["lang"]}"]["text"] = $zaznam["text"];
            $tmp["langtext{$zaznam["lang"]}"] = $zaznam["text"];
        }



        return $tmp;

    }

}