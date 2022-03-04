<?php

/*
 * Add-on for TinyRocket 3.0
 * Modul pro správu regionů pro hotely
 * Pracuje společně s modulem hotels
 *
 */

// MAIN VAULES

// INTERFACE
$ModuleName = "Aktuality";
$ModuleFolder = "aktuality";

if(usertype("admin")) {
    $menu->addTop($ModuleFolder, $ModuleName, 10);
}
// CLASSES
require_once dirname(__FILE__) . '/_aktuality.class.php';

$mainTable = new table("tbAktuality");
$mainTable->column("id", "int", "11", false, false, true, true, false);
$mainTable->column("title", "varchar", "300");
$mainTable->column("perex", "longtext");
$mainTable->column("text", "longtext");
$mainTable->column("autor", "varchar", "1000");
$mainTable->column("photo", "varchar", "1000");
$mainTable->column("views", "int", "11");
$mainTable->column("datum", "datetime");
$mainTable->column("rew", "varchar", "300");
$mainTable->column("isDel", "int", "11");
$mainTable->column("onHp", "int", "11");
$mainTable->column("instituce", "int", "11");

