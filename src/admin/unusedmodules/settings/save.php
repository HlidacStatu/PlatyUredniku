<?php

// původní hodnoty v $_FORM["mail"] atd...


new sql("update tbSouradnice set lat = '$lat', lng = '$lng' where name = 'centrum' ");


$tmpzima = $datezima."".date("Y");
$tmpleto = $dateleto."".date("Y");

//echo_array($tmpzima);
//echo_array($tmpleto);

$datezima = date("Y-m-d 00:00:00", strtotime($tmpzima));
$dateleto = date("Y-m-d 00:00:00", strtotime($tmpleto));

//echo_array($datezima);
//echo_array($dateleto);

new sql("update tbObdobi set datum = '$datezima' where typ = 'zima' ");
new sql("update tbObdobi set datum = '$dateleto' where typ = 'leto' ");




$datazima = new sql("select * from tbObdobi where typ = 'zima'");
$datazima = $datazima->first();


$dataleto = new sql("select * from tbObdobi where typ = 'leto'");
$dataleto = $dataleto->first();


if(strtotime(dateformat($dataleto["datum"], "j.n.").date("Y")) >= strtotime("now") ){
    new sql("update tbObdobi set isActive = '1' where typ = 'zima' ");
    new sql("update tbObdobi set isActive = '0' where typ = 'leto' ");
   // echo "nastvuju zimu 1";

}elseif( strtotime(dateformat($datazima["datum"], "j.n.").date("Y")) >= strtotime("now")  ){
    new sql("update tbObdobi set isActive = '0' where typ = 'zima' ");
    new sql("update tbObdobi set isActive = '1' where typ = 'leto' ");

  //  echo "nastvuju leto";
}else{
    new sql("update tbObdobi set isActive = '1' where typ = 'zima' ");
    new sql("update tbObdobi set isActive = '0' where typ = 'leto' ");
  //  echo "nastvuju zimu 2";
}




new sql("delete from tbVleky where 1 = 1");
new sql("insert into tbVleky set name = '$vleky'");


mess::create("green", "Nastavení bylo uloženo");
$return = true;

continueTo("index");


