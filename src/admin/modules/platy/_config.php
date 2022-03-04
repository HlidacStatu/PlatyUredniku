<?php

/*
 * Add-on for TinyRocket 3.0
 * Modul pro správu regionů pro hotely
 * Pracuje společně s modulem hotels
 * 
 */


// INTERFACE
$ModuleName = "Platy";
$ModuleFolder = "platy";

 $menu->addTop($ModuleFolder, $ModuleName, 2);

// CLASSES
require_once dirname(__FILE__) . '/_platy.class.php';



// TABLES
//   public function column($name, $type, $length = 11, $notNull = true, $default = false, $key = false, $autoIncrement = false, $fulltext = false){
$mainTable = new table("tbPlaty");
$mainTable->column("id", "int", "11", false, false, true, true, false);
$mainTable->column("name", "varchar", "300", true, false, false, false, true);
$mainTable->column("pozice", "int", "11");
$mainTable->column("rok", "int", "11");
$mainTable->column("plat", "int", "11");
$mainTable->column("odmeny", "int", "11");
$mainTable->column("pocetmes", "int", "11");
$mainTable->column("bonus", "int", "11");
$mainTable->column("nefbonus", "varchar", "255");
$mainTable->column("isActive", "int", "2");
$mainTable->column("rew", "varchar", "500");

