<?php 

$page = new page("Editace uživatele");
	
$back = new button('<i class="fa fa-arrow-left"></i> Zpět', 'index', $id);
$back->returnBack();
echo $back->getString();

$page->title();


$data["isActive"] = 1;
$data["isAdmin"] = 1;
$data["type"] = "owner";


if ($target!="-"){
     $data = user::dejData($target);
}


$form = new form();

$idcko = new input("id", $data);
$idcko->hidden();
$form->add($idcko);

$mail = new input("mail", $data, "E-mail");
$mail->mail();
$form->add($mail);



$mail = new input("login", $data, "Login");
$mail->text(4);
$form->add($mail);


if ($id=="-"){
$pass = new input("pass", "", "Nové heslo");
$pass->pass(4, true);
$form->add($pass);
}else{


        $pass = new input("pass", "", "Nové heslo");
        $pass->pass(0, true);
        $pass->help("Pokud nechcete zvolit nové heslo, ponechte při editaci prázdné");
        $form->add($pass);

}


$name = new input("name", $data, "Jméno");
$name->text(4);
$form->add($name);


$name = new input("photo", $data, "Fotografie");
$name->image();
$form->add($name);



$name = new input("telefon1", $data, "Telefon 1");
$name->text();
$form->add($name);
$name = new input("telefon2", $data, "Telefon 2");
$name->text();
$form->add($name);
$name = new input("adresa", $data, "Fakturační adresa");
$name->textarea();
$form->add($name);
$name = new input("ico", $data, "IČ");
$name->text();
$form->add($name);
$name = new input("dic", $data, "DIČ");
$name->text();
$form->add($name);

$isActive = new input("isActive", $data, "Aktivní");
$isActive->option("Ano", "Ne");
$form->add($isActive);

$isAdmin = new input("isAdmin", $data, "Přístup do administrace");
$isAdmin->option("Ano", "Ne");
$form->add($isAdmin);
$name = new input("type", $data, "Typ účtu");
$name->select(array("admin"=>"Administrátor", "owner" => "Vlastník objektů"));
$form->add($name);




$form->plot();


$save = new button('Uložit', 'userSave', $target);
$save->enterSubmit();
echo $save->getString();

?>
</form> 
