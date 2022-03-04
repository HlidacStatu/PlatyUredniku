<?php

/*
 * Add-on for TinyRocket 3.0
 * Modul pro správu regionů pro hotely
 * Pracuje společně s modulem hotels
 * 
 */


// INTERFACE
$ModuleName = "Druh instituce";
$ModuleFolder = "institucedruh";

 $menu->addTop($ModuleFolder, $ModuleName, 6);

// CLASSES
require_once dirname(__FILE__) . '/_institucedruh.class.php';



// TABLES
//   public function column($name, $type, $length = 11, $notNull = true, $default = false, $key = false, $autoIncrement = false, $fulltext = false){
$mainTable = new table("tbInstituceDruh");
$mainTable->column("id", "int", "11", false, false, true, true, false);
$mainTable->column("name", "varchar", "300", true, false, false, false, true);
$mainTable->column("photo", "varchar", "1000");
$mainTable->column("isDel", "int", "2");
$mainTable->column("isActive", "int", "2");
$mainTable->column("ownOrder", "int", "11");
$mainTable->column("rew", "varchar", "500");


