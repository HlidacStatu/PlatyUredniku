<?php

/*
 * USER Control for TinyRocket 3.0
 * 
 * 
 */

// MAIN VAULES
$ModuleCode = "Settings CONTROLER 3.0";

// INTERFACE
$ModuleName = '<i class="fa fa-home"></i> '."Homepage";
$ModuleFolder = "homepage";

if(usertype("admin")) {
    $menu->addBottom($ModuleFolder, $ModuleName, 6);
}
// CLASSES




// TABLES
//   public function column($name, $type, $length = 11, $notNull = true, $default = false, $key = false, $autoIncrement = false, $fulltext = false){

$langTable = new table("tbHomepageLang");
$langTable->column("id", "int", "11", false, false, true, true, false);
$langTable->column("source", "int");
$langTable->column("lang", "int");
$langTable->column("title", "varchar", "300", true, false, false, false, true);
$langTable->column("text", "longtext");

$mainTable = new table("tbHomepageLinks");
$mainTable->column("name", "varchar", "255");
$mainTable->column("val", "varchar", "512");
$mainTable->column("isBlank", "int", "11");


class homepagelang{


    public static function dejData(){
        $query = "SELECT * FROM tbHomepageLang where source = 0 ";
        $data = new sql($query);
        $tmp = array();
        foreach ($data->all() as $zaznam) {
            $tmp["lang"]["{$zaznam["lang"]}"]["title"] = $zaznam["title"];
            $tmp["lang"]["{$zaznam["lang"]}"]["text"] = $zaznam["text"];
            $tmp["langtitle{$zaznam["lang"]}"] = $zaznam["title"];
            $tmp["langtext{$zaznam["lang"]}"] = $zaznam["text"];
        }

        return $tmp;
    }
}


class homepagelinks{


    public static function dejData(){
        $query = "SELECT * FROM tbHomepageLinks ";
        $data = new sql($query);
        $tmp = array();

        $i = 1;
        foreach ($data->all() as $zaznam) {
            $tmp[$i] = $zaznam;

            $i++;
        }

        return $tmp;
    }
}