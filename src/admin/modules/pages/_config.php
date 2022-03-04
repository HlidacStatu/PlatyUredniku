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
$ModuleName = "Stránky";
$ModuleFolder = "pages";

if(usertype("admin")) {
    $menu->addBottom($ModuleFolder, $ModuleName, 15);
}
// CLASSES
require_once dirname(__FILE__) . '/_pages.class.php';
require_once dirname(__FILE__) . '/_pagesOut.class.php';


// TABLES
//   public function column($name, $type, $length = 11, $notNull = true, $default = false, $key = false, $autoIncrement = false, $fulltext = false){
$mainTable = new table("tbPages");
$mainTable->column("id", "int", "11", false, false, true, true, false);
$mainTable->column("title", "varchar", "300", true, false, false, false, true);
$mainTable->column("photo", "varchar", "3000");
$mainTable->column("isDel", "int", "2");
$mainTable->column("text", "longtext");
$mainTable->column("isActive", "int", "2");
$mainTable->column("rew", "varchar", "500");

$langTable = new table("tbPagesLang");
$langTable->column("id", "int", "11", false, false, true, true, false);
$langTable->column("source", "int");
$langTable->column("lang", "int");
$langTable->column("title", "varchar", "300", true, false, false, false, true);
$langTable->column("rew", "varchar", "300");
$langTable->column("text", "longtext");


$langTable = new table("tbPagesPhotos");
$langTable->column("id", "int", "11", false, false, true, true, false);
$langTable->column("source", "int");
$langTable->column("file", "int");
$langTable->column("link", "int");
$langTable->column("ownOrder", "int");
$langTable->column("note", "longtext");
$langTable->column("isDel", "int", "2");