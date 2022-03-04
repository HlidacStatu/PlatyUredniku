<?php


if (file_exists(dirname(__FILE__) . "/import/$rew.php")) {
    require_once dirname(__FILE__) . "/import/$rew.php";

    $file = '../image.jpg';
    $type = 'image/jpeg';
    header('Content-Type:'.$type);
    header('Content-Length: ' . filesize($file));
    readfile($file);
}