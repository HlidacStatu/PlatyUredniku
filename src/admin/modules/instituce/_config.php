<?php

/*
 * Add-on for TinyRocket 3.0
 * Modul pro správu regionů pro hotely
 * Pracuje společně s modulem hotels
 * 
 */


// INTERFACE
$ModuleName = "Instituce";
$ModuleFolder = "instituce";

 $menu->addTop($ModuleFolder, $ModuleName, 5);

// CLASSES
require_once dirname(__FILE__) . '/_instituce.class.php';



// TABLES
//   public function column($name, $type, $length = 11, $notNull = true, $default = false, $key = false, $autoIncrement = false, $fulltext = false){
$mainTable = new table("tbInstituce");
$mainTable->column("id", "int", "11", false, false, true, true, false);
$mainTable->column("name", "varchar", "300", true, false, false, false, true);
$mainTable->column("note", "varchar", "3000");
$mainTable->column("perex", "longtext");
$mainTable->column("contacts", "longtext");
$mainTable->column("photo", "varchar", "3000");
$mainTable->column("isDel", "int", "2");
$mainTable->column("druh", "int", "11");
$mainTable->column("isActive", "int", "2");
$mainTable->column("status", "int", "2");
$mainTable->column("ownOrder", "int", "11");
$mainTable->column("statusNote", "varchar", "200");
$mainTable->column("rew", "varchar", "500");

