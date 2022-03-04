<?php

/*
 * Add-on for TinyRocket 3.0
 * Modul pro správu regionů pro hotely
 * Pracuje společně s modulem hotels
 *
 */

// MAIN VAULES

// INTERFACE
$ModuleName = "Kalendář akcí";
$ModuleFolder = "akce";

if(usertype("admin")) {
    $menu->addTop($ModuleFolder, $ModuleName, 11);
}
// CLASSES
require_once dirname(__FILE__) . '/_akce.class.php';

$mainTable = new table("tbAkce");
$mainTable->column("id", "int", "11", false, false, true, true, false);
$mainTable->column("title", "varchar", "300");
$mainTable->column("perex", "longtext");
$mainTable->column("text", "longtext");
$mainTable->column("misto", "varchar", "300");
$mainTable->column("autor", "varchar", "300");
$mainTable->column("lat", "varchar", "30");
$mainTable->column("lng", "varchar", "30");
$mainTable->column("photo", "varchar", "1000");
$mainTable->column("views", "int", "11");
$mainTable->column("datum", "datetime");
$mainTable->column("isDo", "int", "11");
$mainTable->column("datumDo", "datetime");
$mainTable->column("rew", "varchar", "300");
$mainTable->column("isDel", "int", "11");



$langTable = new table("tbAkceLang");
$langTable->column("id", "int", "11", false, false, true, true, false);
$langTable->column("source", "int");
$langTable->column("lang", "int");
$langTable->column("title", "varchar", "300");
$langTable->column("rew", "varchar", "300");
$langTable->column("text", "longtext");
$langTable->column("perex", "longtext");



$langTable = new table("tbAkcePhotos");
$langTable->column("id", "int", "11", false, false, true, true, false);
$langTable->column("source", "int");
$langTable->column("file", "int");
$langTable->column("link", "int");
$langTable->column("ownOrder", "int");
$langTable->column("note", "longtext");
$langTable->column("isDel", "int", "2");
