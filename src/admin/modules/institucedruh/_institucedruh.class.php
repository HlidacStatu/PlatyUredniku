<?php
/*
 * TynyRocket 3.0
 * Modul pro správu speciálních stránek
 * 
 * (c) 2015
 */


class institucedruh{


    static function dejByRew($rew){
        $rew = sql::escape($rew);
        $query = "SELECT * FROM tbInstituceDruh WHERE rew = '$rew'";
        $data = new sql($query);
        return $data->first();

    }


       static function dejName($id){
        $id = intval($id);
        $query = "SELECT name FROM tbInstituceDruh WHERE id = '$id'";
        $data = new sql($query);
        return $data->first();
    }


    static function dejRew($id){
        $id = intval($id);
        $query = "SELECT rew FROM tbInstituceDruh WHERE id = '$id'";
        $data = new sql($query);
        $tm = $data->first();

        return $tm["rew"];
    }


    static function dejData($id){
        $id = intval($id);
        $query = "SELECT * FROM tbInstituceDruh WHERE id = '$id'";
        $data = new sql($query);
        return $data->first();
    }
    static function returnArray(){
        $query = "SELECT * FROM tbInstituceDruh WHERE isDel = 0 and isActive = 1";
        $data = new sql($query);
        $out = array();
        foreach ($data->all() as $label){
            $out[$label["id"]] = $label["name"];
        }
        return $out;
    }

    static function dejSouvisejici($id){

        $arr1 = array();
        $query = "SELECT poziceA FROM tbInstituceDruhSouvisejici where poziceB = $id";
        $data = new sql($query);
        foreach ($data->all() as $zaznam) {
            $arr1[] = $zaznam["poziceA"];
        }

        $arr2 = array();
        $query = "SELECT poziceB FROM tbInstituceDruhSouvisejici where poziceA = $id";
        $data = new sql($query);
        foreach ($data->all() as $zaznam) {
            $arr2[] = $zaznam["poziceB"];
        }

        return implode(";", ($arr1 + $arr2));
}

    static function dejArray($notid = 0){
        if($notid == "-"){
            $notid == 0;
        }
        $arr = array();

        $query = "SELECT id, name FROM tbInstituceDruh where isDel = 0 and id <> $notid";
        $data = new sql($query);
        foreach ($data->all() as $zaznam) {

            $arr[$zaznam["id"]] = $zaznam["name"];
        }

        return $arr;
    }
  static function dejLangData($id, $lang){
        $id = intval($id);
        $query = "SELECT * FROM tbInstituceDruhLang WHERE source = '$id' and lang = $lang";
          $data = new sql($query);
      return $data->first();
    }
        static function dejList($page, $filtr=""){
	      $page = intval($page);
	   
       if ($page == 1){
	      $query = "SELECT * FROM tbInstituceDruh where 1=1 $filtr order by ownOrder ";
	      $_SESSION["query"] = $query;
	 }
	     $num = 32;
         $page = ($page-1)*$num;

	    $query = $_SESSION["query"]." LIMIT $page,$num";


            $data = new sql($query);
        $out = "";
        foreach ($data->all() as $zaznam) {
            $line = new line($zaznam["name"], $zaznam["id"]);
            $line->dragable();
	    $line->addIcon($zaznam["photo"], "img/tag.png");
	    
	    $del = new button('<i class="fa fa-times"></i> Smazat', 'labelDel', $zaznam["id"], "del", "red");
	    $edit = new button('<i class="fa fa-pencil"></i> Upravit', 'labelEdit', $zaznam["id"]);
	    
	    $line->addButton($del->getString());
	    $line->addButton($edit->getString());
	     
	    $line->langButtons("labelLang", $zaznam["id"]);
	    
	    $out .= $line->getString();
        }
        return $out;
    }
   
}
