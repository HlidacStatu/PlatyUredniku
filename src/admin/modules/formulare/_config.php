<?php

/*
 * Add-on for TinyRocket 3.0
 * Modul pro správu regionů pro hotely
 * Pracuje společně s modulem hotels
 * 
 */

// MAIN VAULES
$ModuleCode = "PAGES";

// INTERFACE
$ModuleName = "Odeslané formuláře";
$ModuleFolder = "formulare";

//$menu->addBottom($ModuleFolder, $ModuleName, 13);

// CLASSES
class formulare{
        static function dejData($id){
            $query = "SELECT * FROM tbFormulare where id = $id";
            $data = new sql($query);
            return $data->first();
        }

    static function dejSetData($lang){
        $lang = intval($lang);
        $query = "SELECT * FROM tbFormulareSet where lang = $lang";
        $data = new sql($query);
        return $data->first();
    }


    static function dejList($page, $filtr=""){
        $page = intval($page);

        if ($page == 1){
            $query = "SELECT * FROM tbFormulare where 1=1 $filtr ";
            $_SESSION["query"] = $query;
        }
        $num = 32;
        $page = ($page-1)*$num;

        $query = $_SESSION["query"]." order by date desc LIMIT $page,$num";


        $data = new sql($query);
        $out = "";
        foreach ($data->all() as $zaznam) {
            $line = new line($zaznam["mail"]);
            $line->addIcon($zaznam["photo"], "img/content.png");
            $line->addNote(dateformat($zaznam["date"]));
            $line->addNote($zaznam["url"]);

            $del = new button('<i class="fa fa-times"></i> Smazat', 'labelDel', $zaznam["id"], "del", "red");
            $edit = new button('<i class="fa fa-eye"></i> Zobrazit', 'labelEdit', $zaznam["id"], "note");

            $line->addButton($del->getString());
            $line->addButton($edit->getString());



            $out .= $line->getString();
        }
        return $out;
    }

    }





// TABLES
//   public function column($name, $type, $length = 11, $notNull = true, $default = false, $key = false, $autoIncrement = false, $fulltext = false){
$mainTable = new table("tbFormulareSet");
$mainTable->column("lang", "int", "11", false, false, true, false, false);

$mainTable->column("mail", "varchar", "200");


//   public function column($name, $type, $length = 11, $notNull = true, $default = false, $key = false, $autoIncrement = false, $fulltext = false){
$mainTable = new table("tbFormulare");

$mainTable->column("id", "int", "11", false, false, true, true, false);


$mainTable->column("mail", "varchar", "500");
$mainTable->column("url", "varchar", "500");
$mainTable->column("source", "int", "11");
$mainTable->column("data", "longtext");
$mainTable->column("date", "datetime");
$mainTable->column("isDel", "int", "11");


