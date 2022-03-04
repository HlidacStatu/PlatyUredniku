<?php
/*
 * TynyRocket 3.0
 * Modul pro správu speciálních stránek
 * 
 * (c) 2015
 */


class platy{
       static function dejName($id){
        $id = intval($id);
        $query = "SELECT name FROM tbPlaty WHERE id = '$id'";
        $data = new sql($query);
        return $data->first();
    }
  
    static function dejData($id){
        $id = intval($id);
        $query = "SELECT * FROM tbPlaty WHERE id = '$id'";
        $data = new sql($query);
        return $data->first();
    }
    static function dejCount($pozice){
        $query = "SELECT count(id) as celkem FROM tbPlaty WHERE isDel = 0 and isActive = 1 and pozice = $pozice";
        $data = new sql($query);
        foreach ($data->all() as $label){
            return $label["celkem"];
        }
        return 0;
    }
    static function returnArray(){
        $query = "SELECT * FROM tbPlaty WHERE isDel = 0 and isActive = 1 order by name";
        $data = new sql($query);
        $out = array();
        foreach ($data->all() as $label){
            $out[$label["id"]] = $label["name"];
        }
        return $out;
    }

  static function dejLangData($id, $lang){
        $id = intval($id);
        $query = "SELECT * FROM tbPlatyLang WHERE source = '$id' and lang = $lang";
          $data = new sql($query);
      return $data->first();
    }
        static function dejList($page, $filtr=""){
	      $page = intval($page);
	   
       if ($page == 1){
	      $query = "SELECT * FROM tbPlaty where 1=1 $filtr ";
	      $_SESSION["query"] = $query;
	 }
	     $num = 32;
         $page = ($page-1)*$num;

	    $query = $_SESSION["query"]." LIMIT $page,$num";


            $data = new sql($query);
        $out = "";

        $pozice = pozice::returnArray();
        foreach ($data->all() as $zaznam) {
            $line = new line($pozice[$zaznam["pozice"]]);
	    $line->addIcon($zaznam["photo"], "img/tag.png");
	    $line->addNote($zaznam["rok"]);
	    $line->addNote($zaznam["plat"]."/".$zaznam["odmeny"]."/".$zaznam["bonus"]."/".$zaznam["nefbonus"]);
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
