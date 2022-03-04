<?php

/*
 * Add-on for TinyRocket 3.0
 * Modul pro správu regionů pro hotely
 * Pracuje společně s modulem hotels
 * 
 */


// INTERFACE
$ModuleName = "Pozice";
$ModuleFolder = "pozice";

 $menu->addTop($ModuleFolder, $ModuleName, 5);

// CLASSES
require_once dirname(__FILE__) . '/_pozice.class.php';



// TABLES
//   public function column($name, $type, $length = 11, $notNull = true, $default = false, $key = false, $autoIncrement = false, $fulltext = false){
$mainTable = new table("tbPozice");
$mainTable->column("id", "int", "11", false, false, true, true, false);
$mainTable->column("name", "varchar", "300", true, false, false, false, true);
$mainTable->column("note", "varchar", "255");
$mainTable->column("perex", "longtext");
$mainTable->column("photo", "varchar", "3000");
$mainTable->column("isDel", "int", "2");
$mainTable->column("instituce", "int", "11");
$mainTable->column("views", "int", "11");
$mainTable->column("isActive", "int", "2");
$mainTable->column("ownOrder", "int", "11");
$mainTable->column("rew", "varchar", "500");


$mainTable = new table("tbPoziceSouvisejici");
$mainTable->column("id", "int", "11", false, false, true, true, false);
$mainTable->column("poziceA", "int", "11");
$mainTable->column("poziceB", "int", "11");