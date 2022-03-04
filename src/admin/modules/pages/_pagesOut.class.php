<?php
/*
 * TynyRocket 3.0
 * Modul pro správu speciálních stránek
 * 
 * (c) 2015
 */


class pageout extends pages{

    public $name;
    public $title;
    public $photo;
    public $text;
    public $rew;
    public $id = false;

    static function link($idcko, $lang = 1){

        $query = new sql("SELECT id, rew FROM tbPages WHERE id = '{$idcko}' ");

        $link = "/";

        foreach ($query->all() as $zaznam) {

            $labRewData = new sql("select rew from tbPagesLang where source = {$zaznam["id"]} and lang = $lang");
            foreach ($labRewData->all() as $tmp){
                $zaznam["rew"] = $tmp["rew"];
            }


            $link .= $zaznam["rew"];
        }

        return $link;
    }

    public function __construct($id = ""){
        if(!empty($id)) {
            $this->id = $id;
            $this->byid();
        }

    }
    public function byid($id = ""){
        if(!empty($id)) {
            $this->id = $id;
        }

        $query = new sql("SELECT * FROM tbPages WHERE id = '{$this->id}' ");
        foreach ($query->all() as $zaznam) {
            $this->name = $zaznam["name"];
            $this->title = $zaznam["title"];
            $this->text = $zaznam["text"];
            $this->rew = $zaznam["rew"];
            $this->photo = $zaznam["photo"];
        }






    }

    public function byrew($rew = ""){

        $query = new sql("SELECT * FROM tbPages WHERE rew = '{$rew}' and isDel = 0 ");


        foreach ($query->all() as $zaznam) {
            $this->id = $zaznam["id"];
            $this->name = $zaznam["name"];
            $this->title = $zaznam["title"];
            $this->text = $zaznam["text"];
            $this->rew = $zaznam["rew"];
            $this->photo = $zaznam["photo"];
        }



    }

   
}
