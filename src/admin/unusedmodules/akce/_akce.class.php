<?php
/*
 * TynyRocket 3.0
 * Modul pro správu speciálních stránek
 * 
 * (c) 2015
 */


class akce{
      public static function dejName($id){
        $id = intval($id);
        $query = "SELECT name FROM tbAkce WHERE id = '$id'";
        $data = new sql($query);
        return $data->first();
    }
   public static function kategorie(){
        $query = "SELECT kategorie FROM tbAkce group by kategorie ";
        $data = new sql($query);
        $arr = array();
        foreach ($data->all() as $zaznam) {
            $arr["{$zaznam["kategorie"]}"] = $zaznam["kategorie"];
        }
        return $arr;
    }

   public static function link($idcko, $lang = 1){
        $query = new sql("SELECT id, rew FROM tbAkce WHERE id = '{$idcko}' ");

        $link = "/akce/";

        foreach ($query->all() as $zaznam) {



            $labRewData = new sql("select rew from tbAkceLang where source = {$zaznam["id"]} and lang = $lang");
            foreach ($labRewData->all() as $tmp){
                $zaznam["rew"] = $tmp["rew"];
            }

            $link .= $zaznam["rew"];
        }

        return $link;
    }


   public static function dejArray(){

        $out = array();

        $query = "SELECT * FROM tbAkce  where isDel = 0  order by title";


        $data = new sql($query);
        foreach ($data->all() as $zaznam) {
            $out[$zaznam["id"]] = $zaznam["title"];
        }
        return $out;
    }

   public static function dejData($id){
        $id = intval($id);
        $query = "SELECT * FROM tbAkce WHERE id = '$id'";
        $data = new sql($query);

        $tmp = $data->first();



        $query = "SELECT * FROM tbAkceLang where source = {$tmp["id"]} ";
        $data = new sql($query);
        foreach ($data->all() as $zaznam) {
            $tmp["lang"]["{$zaznam["lang"]}"]["title"] = $zaznam["title"];
            $tmp["lang"]["{$zaznam["lang"]}"]["text"] = $zaznam["text"];
            $tmp["lang"]["{$zaznam["lang"]}"]["perex"] = $zaznam["perex"];
            $tmp["langtitle{$zaznam["lang"]}"] = $zaznam["title"];
            $tmp["langtext{$zaznam["lang"]}"] = $zaznam["text"];
            $tmp["langperex{$zaznam["lang"]}"] = $zaznam["perex"];
        }
        $tmp["lang"]["1"]["title"] = $tmp["title"];
        $tmp["lang"]["1"]["text"] = $tmp["text"];
        $tmp["lang"]["1"]["perex"] = $tmp["perex"];
        $tmp["langtitle1"] = $tmp["title"];
        $tmp["langtext1"] = $tmp["text"];
        $tmp["langperex1"] = $tmp["perex"];



        return $tmp;

    }


   public static function dejRewFromID($id){
        $query = "SELECT * FROM tbAkce WHERE id = '$id'";
        $data = new sql($query);
        $tmp = $data->first();
        return $tmp["rew"];
    }

   public static function dejByRew($rew, $redirect = true){

        $query = new sql("SELECT * FROM tbAkceLang WHERE rew = '{$rew}' and lang = {$_SESSION["lang"]}");
        foreach ($query->all() as $zaznam) {
            $idcko = $zaznam["source"];
            $out = $zaznam;
        }

        if(!$out){

            $query = new sql("SELECT * FROM tbAkceLang WHERE rew = '{$rew}' ");
            foreach ($query->all() as $zaznam) {
                $idcko = $zaznam["source"];
                $out = $zaznam;
            }
        }





        $query = "SELECT * FROM tbAkce WHERE id = '$idcko'";
        $data = new sql($query);
        $out =  $data->first();

        if(!empty($out)) {


            $views = $out["views"] + 1;


            $query = "SELECT * FROM tbAkceLang where source = {$out["id"]} and lang = {$_SESSION["lang"]}";
            $data = new sql($query);
            foreach ($data->all() as $zaznam) {
                $out["title"] = $zaznam["title"];
                $out["text"] = $zaznam["text"];
                $out["perex"] = $zaznam["perex"];
            }


            new sql("Update tbAkce set views = $views where isDel = 0 and rew = '$rew'");
        }
        return $out;
    }

       public static function dejList($page, $filtr=""){
	      $page = intval($page);
	   
       if ($page == 1){
	      $query = "SELECT * FROM tbAkce where 1=1 $filtr ";
	      $_SESSION["query"] = $query;
	 }
	 $num = 64;
         $page = ($page-1)*$num;

	$query = $_SESSION["query"]." LIMIT $page,$num";


            $data = new sql($query);
        $out = "";
        foreach ($data->all() as $zaznam) {
            $line = new line($zaznam["title"]);
	        $line->addIcon($zaznam["photo"], "img/page.png");

            $line->addNote($zaznam["autor"]);
            $line->addNote("Zobrazení: ".$zaznam["views"]);

            if($zaznam["datumDo"] != "0000-00-00 00:00:00"){
                $dateDo = " - ".dateformat($zaznam["datumDo"]);
            }

            if(!empty($zaznam["misto"])){
                $place = ", ".$zaznam["misto"];
            }

            $line->addNote(dateformat($zaznam["datum"]).$dateDo.$place);
	        $line->addNote('<a href="/akce/'.$zaznam["rew"].'" target="_blank">Otevřít</a>' );
	    
	        $del = new button('<i class="fa fa-times"></i> Smazat', 'pageDel', $zaznam["id"], "del", "red");
	        $edit = new button('<i class="fa fa-pencil"></i> Upravit', 'pageEdit', $zaznam["id"]);
	    
	        $line->addButton($del->getString());
	        $line->addButton($edit->getString());
	     
	        $line->langButtons("pageLangEdit", $zaznam["id"]);
	    
	        $out .= $line->getString();
        }
        return $out;
    }








   public static function dejPhotoList($id){
        $query = "SELECT p.ownOrder, p.note, f.* FROM tbAkcePhotos p left join tbFiles f on p.file = f.id WHERE p.source = $id and p.isDel = 0 order by ownOrder";
        $data = new sql($query);
        $out = "";
        foreach ($data->all() as $zaznam){

            $out .= self::oneline($zaznam, $id);

        }
        return $out;
    }

   public static function dejPhotoArray($id){
        $query = "SELECT p.ownOrder, p.note, f.* FROM tbAkcePhotos p left join tbFiles f on p.file = f.id WHERE p.source = $id and p.isDel = 0 order by ownOrder";
        $data = new sql($query);
        $out = array();
        foreach ($data->all() as $zaznam){

            $out[] = $zaznam;

        }
        return $out;
    }

   public static function onePhoto($id, $source){
        $id = intval($id);
        $source = intval($source);
        $query = "SELECT * FROM tbFiles where id = $id";
        $data = new sql($query);
        $out = "";

        foreach ($data->all() as $zaznam){
            $out .= self::oneline($zaznam, $source);

            $query = "INSERT INTO tbAkcePhotos SET source=$source, file = {$zaznam["id"]}, ownOrder = 0";
            new sql($query);
            $query = "UPDATE tbFiles SET hidden = 1 WHERE id = $id";
            new sql($query);
        }
        return $out;
    }


   public static function oneline($zaznam, $id){


        $photoData = photoData($zaznam["id"]);


        $line = new line($zaznam["name"], $zaznam["id"]);
        $line->addIcon($zaznam["link"], "img/photo.png");
        $line->dragable();
        $line->big();
        $line->addNote('<i class="fa fa-camera"></i> '.$photoData["device"] );

        if(empty($photoData["date"])){
            $photoData["date"] = $zaznam["date"];
        }

        $line->addNote('<i class="fa fa-calendar"></i> '.date("j.n.Y H:i", (strtotime($photoData["date"]))) );
        $line->addNote('Apperture: '.$photoData["aperture"] );
        $line->addNote('Focal length: '.$photoData["focal"] );
        $line->addNote('Exposure time: '.$photoData["exposure"] );
        $line->addNote('Exposure time: '.$photoData["exposure"] );
        $line->addNote('ISO '.$photoData["iso"] );
        $line->addNote('<a href="'.$zaznam["link"].'" target="_blank">Zobrazit v plném rozlišení</a>' );

        $line->addButton("<div onclick=\"galDel($(this));\" class=\"btn a red photolinedel   \" page=\"photoDel\" title=\"\" do=\"storno\" source=\"1\" target=\"{$zaznam["id"]}\"><i class=\"fa fa-times\"></i> Smazat</div>");

        $note = new button('<i class="fa fa-pencil-square-o"></i> Popisek', 'photoNote', $zaznam["id"], "note");
        $note->addSource($id);
        $line->addButton($note->getString());

        return $line->getString();

    }

   public static function photoData($id){
        $id = intval($id);
        $query = "SELECT p.note, f.* FROM tbFiles f inner join tbAkcePhotos p on f.id = p.file WHERE f.id = '$id'";
        $data = new sql($query);
        return $data->first();
    }


}
