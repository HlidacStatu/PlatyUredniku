<?php

//
// TinyRocket 4
// Core
//  _____            _        _     _  _
// |  __ \          | |      | |   | || |
// | |__) |___   ___| | _____| |_  | || |_
// |  _  // _ \ / __| |/ / _ \ __| |__   _|
// | | \ \ (_) | (__|   <  __/ |_     | |
// |_|  \_\___/ \___|_|\_\___|\__|    |_|
//
// Build 2016/4/21
//

 //$runInstall = true;

// Database (MySQL Access)
$rocket["dbServer"] = 'platyurednikudb';
$rocket["dbUser"] = 'platyuredniku_cz';
$rocket["dbPass"] = 'WuodukOmUj0';
$rocket["dbName"] = 'platyuredniku_cz_db';

// Default sender
$rocket["mail"] = "info@platyuredniku.cz";

$rocket["metaimage"] = "/img/pu-og-deaf2.png";
$rocket["metaimageheight"] = "1048";
$rocket["metaimagewidth"] = "2526";

// Server
$rocket["name"] = 'Platy úředníků';
$rocket["adminLogo"] = '/admin/img/logo.png';
$rocket["domain"] = 'platyuredniku.loc';

// Rocket
$rocket["versionName"] = "Rocket Core";
$rocket["version"] = "4.0";
$rocket["bottom"] = "&nbsp; | &nbsp; Created by <a href='http://netservis.cz'>NETservis</a> &nbsp; | &nbsp; PHP ".phpversion()."	";


// Upload options
$rocket["convertPNGtoJPG"] = true;
$rocket["watermarkForFullSize"] = false;
$rocket["watermarkFile"] = dirname(__FILE__) . '/../img/dev.png';
$rocket["fullSize"] = "1248"; //px;
$rocket["mediumSize"] = "512"; //px;
$rocket["smallSize"] = "248"; //px;
$rocket["bigSize"] = "1920"; //px;
$rocket["allowedExtensions"]  = array("gif", "jpeg", "jpg", "png", "pdf", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "zip", "rar", "exe", "srt", "txt");
$rocket["fotoExtensions"] = array("gif", "jpeg", "jpg", "png");

/*
 * Copy optional modules to /modules folder
 */

