<?php

// původní hodnoty v $_FORM["mail"] atd...



$rew = rewrite::getRewrite($name, "tbPozice", $id);

$query = " SET  name = '$name',
		isActive = '$isActive',
		photo = '$photo',
			perex = '$perex',
			instituce = '$instituce',
		note = '$note',
		rew = '$rew'
	 ";
	
if ($id == "-"){
    $query = "INSERT INTO tbPozice $query";
    $tmp = new sql($query);

    $idcko = $tmp->inserted();






}else{
    $query = "UPDATE tbPozice $query WHERE id = $id";
    $tmp = new sql($query);

    $idcko = $id;
}


$_SESSION["labelControlLastFilter"]["platy"] = $idcko;

if($rovnouplat1 == 1){
    $platrew = rewrite::getRewrite($platname1, "tbPlaty", "-");
    $query = " SET  name = '$platname1',
		isActive = '$platisActive1',
		pozice = '$idcko',
		rok = '$platrok1',
		plat = '$platplat1',
		odmeny = '$platodmeny1',
		pocetmes = '$platpocetmes1',
		bonus = '$platbonus1',
		nefbonus = '$platnefbonus1',
		rew = '$platrew'
	 ";
    $query = "INSERT INTO tbPlaty $query";
    new sql($query);
}

if($rovnouplat2 == 1){
    $platrew = rewrite::getRewrite($platname2, "tbPlaty", "-");
 //   echo_array($query);
    $query = " SET  name = '$platname2',
		isActive = '$platisActive2',
		pozice = '$idcko',
		rok = '$platrok2',
		plat = '$platplat2',
		odmeny = '$platodmeny2',
		pocetmes = '$platpocetmes2',
		bonus = '$platbonus2',
		nefbonus = '$platnefbonus2',
		rew = '$platrew'
	 ";
    $query = "INSERT INTO tbPlaty $query";
    new sql($query);
}

if($rovnouplat3 == 1){
    $platrew = rewrite::getRewrite($platname3, "tbPlaty", "-");
//    echo_array($query);
    $query = " SET  name = '$platname3',
		isActive = '$platisActive3',
		pozice = '$idcko',
		rok = '$platrok3',
		plat = '$platplat3',
		odmeny = '$platodmeny3',
		pocetmes = '$platpocetmes3',
		bonus = '$platbonus3',
		nefbonus = '$platnefbonus3',
		rew = '$platrew'
	 ";
    $query = "INSERT INTO tbPlaty $query";
 //   echo_array($query);
    new sql($query);
}

if($rovnouplat4 == 1){
    $platrew = rewrite::getRewrite($platname4, "tbPlaty", "-");
    $query = " SET  name = '$platname4',
		isActive = '$platisActive4',
		pozice = '$idcko',
		rok = '$platrok4',
		plat = '$platplat4',
		odmeny = '$platodmeny4',
		pocetmes = '$platpocetmes4',
		bonus = '$platbonus4',
		nefbonus = '$platnefbonus4',
		rew = '$platrew'
	 ";
    $query = "INSERT INTO tbPlaty $query";
  //  echo_array($query);
    new sql($query);
}


if(!empty($_FORM["souvisejici"])) {
    $souvisejici = explode(";", $_FORM["souvisejici"]);

    foreach ($souvisejici as $item) {

        new sql("delete from tbPoziceSouvisejici where poziceA = $idcko and poziceB = $item");
        new sql("delete from tbPoziceSouvisejici where poziceB = $idcko and poziceA = $item");
        new sql("insert into tbPoziceSouvisejici set poziceA = $idcko, poziceB = $item");

    }

}
mess::create("green", "Pozice byla uložena");
$return = true;


if($continueToPlat == 1){
    $source = $idcko;
    $target = "-";

    continueTo("platEdit");
}else{

    continueTo("index");
}