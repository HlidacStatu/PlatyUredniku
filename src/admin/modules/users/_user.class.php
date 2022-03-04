<?php

/*
 * TynyRocket 3.0
 * Modul pro správu uživatelských účtů
 * 
 * (c) 2015
 */


class user
{



    public function __construct($id)
    {


    }

    static function userTypeLabel($type){
        if($type == "admin"){
            $out = "Administrátor";
        }
        if($type == "owner"){
            $out = "Vlastník objektu";
        }

        return "<span class=linelabel>$out</span>";
    }


    static function overMail($mail)
    {
        new sql("UPDATE tbUsers SET isActive = 1 WHERE mail = '" . valid($mail) . "'  ");

    }

    static function hashPass($in){
        return md5(sha1(str_replace(substr($in, 0, intval(strlen($in)/2)), "", $in)).md5($in).sha1(substr($in, 0, intval(strlen($in)/2))));
    }

    static function dejData($id)
    {
        $id = intval($id);
        $query = new sql("SELECT * FROM tbUsers WHERE id = '$id'");
        return $query->first();
    }

    static function dejListSelect($sql){
        $query = "SELECT * FROM tbUsers where isDel = 0 $sql order by name ";
        $data = new sql($query);
        $arr = array();
        foreach ($data->all() as $zaznam) {
            $arr["{$zaznam["id"]}"] = $zaznam["name"];
        }
        return $arr;

    }
    static function dejOwned($user){
        $out = new sql("select id, title from tbObjekt where id in (select objekt from tbUsersOwners where owner = '$user')");
        return $out->all();
    }

    static function dejOwned4select($user){
        $out = array();
        foreach (self::dejOwned($user) as $val){
            $out[] = $val["id"];
        }
        return implode(",", $out);
    }


    static function dejOwners($objekt){
        $out = new sql("select * from tbUsers where id in (select owner from tbUsersOwners where objekt = '$objekt') order by name");
        return $out->all();
    }

    static function dejList($page, $filtr = "")
    {
        $page = intval($page);

        if ($page == 1) {
            $query = "SELECT * FROM tbUsers where isDel = 0 $filtr ";
            $_SESSION["query"] = $query;
        }
        $num = 8;
        $page = ($page - 1) * $num;

        $query = new sql($_SESSION["query"] . " LIMIT $page,$num");

        $out = "";
        foreach ($query->all() as $zaznam) {
            $line = new line( self::userTypeLabel($zaznam["type"]).$zaznam["name"]);
            $line->addIcon($zaznam["photo"], "img/user.png");
            $line->addNote($zaznam["login"]."/".$zaznam["mail"]);
            $line->addNote('Poslední přihlášení: ' . date("j.n.Y", (strtotime($zaznam["last"]))));
            $del = new button('<i class="fa fa-times"></i> Smazat', 'userDel', $zaznam["id"], "del", "red");
            $edit = new button('<i class="fa fa-pencil"></i> Upravit', 'userEdit', $zaznam["id"]);
            $line->addButton($del->getString());
            $line->addButton($edit->getString());

            $out .= $line->getString();
        }
        return $out;
    }

    static function login($mail, $pass, $isAdmin = 1)
    {
        $pass = self::hashPass($pass);
        $mail = valid($mail);

        $mail = trim(strtolower($mail));

        $query = new sql("SELECT count(*) as celkem FROM tbUsers WHERE ( mail = '$mail' or login = '$mail') AND pass='$pass' AND isActive = 0 AND isDel = 0 AND isAdmin = 1");
        foreach ($query->all() as $zaznam) {
            if ($zaznam["celkem"] == 1) {
                return 2;
            }
        }
        

        $query = new sql("SELECT isadmin,id,mail,name,type, count(*) as celkem FROM tbUsers WHERE ( mail = '$mail' or login = '$mail') AND pass='$pass' AND isActive = 1 AND isDel = 0 AND isAdmin = 1 group by isadmin,id,mail,name,type");
        foreach ($query->all() as $zaznam) {
            if ($zaznam["celkem"] == 1) {
                $_SESSION["loged"] = true;
                $_SESSION["isAdmin"] = $zaznam["isAdmin"];
                $_SESSION["id"] = $zaznam["id"];
                $_SESSION["client"] = $zaznam["client"];
                $_SESSION["mail"] = $zaznam["mail"];
                $_SESSION["name"] = $zaznam["name"];
                $_SESSION["type"] = $zaznam["type"];
                setcookie("TinyRocket_LastUser", $zaznam["id"], strtotime('+30 days'), '/');
                new sql("UPDATE tbUsers SET last = NOW() WHERE id ={$_SESSION["id"]} ");

                return 1;
            }
        }
        return 0;
    }

    static function dataProLogin($id)
    {
        $id = intval($id);
        $query = new sql("SELECT * FROM tbUsers WHERE id = '$id'");
        foreach ($query->all() as $zaznam) {
            $user["mail"] = $zaznam["mail"];
            $user["photo"] = $zaznam["photo"];
            $user["name"] = $zaznam["name"];
        }
        return $user;
    }


}
