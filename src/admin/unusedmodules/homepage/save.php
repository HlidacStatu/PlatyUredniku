<?php

// původní hodnoty v $_FORM["mail"] atd...






new sql("delete from tbHomepageLang where 1 = 1");



foreach (lang::dejArray() as $lang){


    $rew = rewrite::getRewrite(${"langtitle".$lang["id"]});
    $tmp = new sql("insert into tbHomepageLang set title='".${"langtitle".$lang["id"]}."', text ='".${"langtext".$lang["id"]}."',  source = '0', lang = '{$lang["id"]}'");

}




new sql("delete from tbHomepageLinks where 1 = 1");


$tmp = new sql("insert into tbHomepageLinks set name='".$linkname1."', val = '$linkval1',  isBlank = '$isBlank1'");
$tmp = new sql("insert into tbHomepageLinks set name='".$linkname2."', val = '$linkval2',  isBlank = '$isBlank2'");

mess::create("green", "Nastavení bylo uloženo");
$return = true;

continueTo("index");


