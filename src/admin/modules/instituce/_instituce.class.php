<?php
/*
 * TynyRocket 3.0
 * Modul pro správu speciálních stránek
 * 
 * (c) 2015
 */


class instituce{

    static function statusy(){
        return array(1 => "Zaslána kompletní data/platy dané zákonem", 2 => "Zaslána nekompletní data", 3 => "Data nezaslána");
    }
    static function statusName($status){
        $tmp = self::statusy();
        return $tmp[$status];
    }
    static function dejByRew($rew){
        $rew = sql::escape($rew);
        $query = "SELECT * FROM tbInstituce WHERE rew = '$rew' and isDel = 0 ";
        $data = new sql($query);
        return $data->first();

    }


    static function dejRew($id){
        $id = intval($id);
        $query = "SELECT rew, druh FROM tbInstituce WHERE id = '$id'";
        $data = new sql($query);
      foreach ($data->all() as $item){
          return "/".institucedruh::dejRew($item["druh"])."/".$item["rew"];
      }


    }


    static function dejName($id){
        $id = intval($id);
        $query = "SELECT name FROM tbInstituce WHERE id = '$id'";
        $data = new sql($query);
        return $data->first();
    }
  
    static function dejData($id){
        $id = intval($id);
        $query = "SELECT * FROM tbInstituce WHERE id = '$id'";
        $data = new sql($query);
        return $data->first();
    }
    static function returnArray(){
        $query = "SELECT * FROM tbInstituce WHERE isDel = 0  order by name";
        $data = new sql($query);
        $out = array();
        foreach ($data->all() as $label){
            $out[$label["id"]] = $label["name"];
        }
        return $out;
    }

  static function dejLangData($id, $lang){
        $id = intval($id);
        $query = "SELECT * FROM tbInstituceLang WHERE source = '$id' and lang = $lang";
          $data = new sql($query);
      return $data->first();
    }
        static function dejList($page, $filtr=""){
	      $page = intval($page);
	   
       if ($page == 1){
	      $query = "SELECT * FROM tbInstituce where 1=1 $filtr  order by ownOrder ";
	      $_SESSION["query"] = $query;
	 }
	     $num = 32;
         $page = ($page-1)*$num;

	    $query = $_SESSION["query"]." LIMIT $page,$num";


            $data = new sql($query);
        $out = "";
        $statusy = self::statusy();
        $druhy = institucedruh::dejArray();
        foreach ($data->all() as $zaznam) {
            $line = new line($zaznam["name"], $zaznam["id"]);
            $line->dragable();
	    $line->addIcon($zaznam["photo"], "img/tag.png");


            $line->addNote($druhy[$zaznam["druh"]]);
            $line->addNote($statusy[$zaznam["status"]]);

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
