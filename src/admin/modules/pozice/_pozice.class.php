<?php
/*
 * TynyRocket 3.0
 * Modul pro správu speciálních stránek
 * 
 * (c) 2015
 */


class pozice{
       static function dejName($id){
        $id = intval($id);
        $query = "SELECT name FROM tbPozice WHERE id = '$id'";
        $data = new sql($query);
        return $data->first();
    }

    static function dejByRew($rew, $ins = false){
           if(empty($rew)){
               return false;
           }
        $rew = sql::escape($rew);
           if($ins){
               $query = "SELECT * FROM tbPozice WHERE rew = '$rew' and instituce = '$ins' and isDel = 0";
           }else{
               $query = "SELECT * FROM tbPozice WHERE rew = '$rew' and isDel = 0";
           }


        $data = new sql($query);
        $data = $data->first();


        if(empty($data["id"])){
            return false;
        }

        $data["views"] += 1;
        new sql("update tbPozice set views = {$data["views"]} where id = {$data["id"]} ");

        return $data;

    }
    static function dejData($id){
        $id = intval($id);
        $query = "SELECT * FROM tbPozice WHERE id = '$id'";
        $data = new sql($query);
        return $data->first();
    }
    static function returnArray(){
        $query = "SELECT * FROM tbPozice WHERE isDel = 0 and isActive = 1 order by name";
        $data = new sql($query);
        $out = array();
        foreach ($data->all() as $label){
            $out[$label["id"]] = $label["name"];
        }
        return $out;
    }

    static function dejSouvisejici($id){


        if($id == "-"){
            $id = 0;
        }
        $arr1 = array();
        $query = "SELECT poziceA FROM tbPoziceSouvisejici where poziceB = $id";
        $data = new sql($query);
        foreach ($data->all() as $zaznam) {
            $arr1[] = $zaznam["poziceA"];
        }

        $arr2 = array();
        $query = "SELECT poziceB FROM tbPoziceSouvisejici where poziceA = $id";
        $data = new sql($query);
        foreach ($data->all() as $zaznam) {
            $arr2[] = $zaznam["poziceB"];
        }

        return implode(";", ($arr1 + $arr2));
}

    static function dejArray($notid){
        if($notid == "-"){
            $notid = 0;
        }
        $arr = array();

        $query = "SELECT id, name FROM tbPozice where isDel = 0 and id <> $notid order by name";
        $data = new sql($query);
        foreach ($data->all() as $zaznam) {

            $arr[$zaznam["id"]] = $zaznam["name"];
        }

        return $arr;
    }
  static function dejLangData($id, $lang){
        $id = intval($id);
        $query = "SELECT * FROM tbPoziceLang WHERE source = '$id' and lang = $lang";
          $data = new sql($query);
      return $data->first();
    }
        static function dejList($page, $filtr=""){
	      $page = intval($page);
	   
       if ($page == 1){
	      $query = "SELECT * FROM tbPozice where 1=1 $filtr order by ownOrder";
	      $_SESSION["query"] = $query;
	 }
	     $num = 32;
         $page = ($page-1)*$num;

	    $query = $_SESSION["query"]." LIMIT $page,$num";


	    $instutcearr = instituce::returnArray();

            $data = new sql($query);
        $out = "";
        foreach ($data->all() as $zaznam) {
            $line = new line($zaznam["name"], $zaznam["id"]);
            $line->dragable();

            $line->addNote($instutcearr[$zaznam["instituce"]]);

	    $line->addIcon($zaznam["photo"], "img/tag.png");

	    $count = platy::dejCount($zaznam["id"]);

	    $del = new button('<i class="fa fa-times"></i>', 'labelDel', $zaznam["id"], "del", "red");
	    $edit = new button('<i class="fa fa-pencil"></i> Upravit', 'labelEdit', $zaznam["id"]);
	    $edit2 = new button('<i class="fa fa-money"></i> Platy ('.$count.')', 'labelPlaty', $zaznam["id"]);

	    $line->addButton($del->getString());
	    $line->addButton($edit->getString());
	    $line->addButton($edit2->getString());

	    $line->langButtons("labelLang", $zaznam["id"]);
	    
	    $out .= $line->getString();
        }
        return $out;
    }
   
}
