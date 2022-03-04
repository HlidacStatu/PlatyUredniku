<meta charset="utf-8" />
<?php




$query = "delete from tbFulltext where 1 = 1";
new sql($query);









// stranky


    $query = "SELECT * FROM tbPages WHERE isDel = 0 and isActive = 1 ";
    $all = new sql($query);
    foreach ($all->all() as $item){
        $item["photo"] = $item["photo"];


        $perex = mb_substr(strip_tags($item["text"]),0, 200, "utf-8");

        $search = strip_tags($item["text"])." ".$item["rewrite"]." ".$item["title"]." ".$item["title"]." ".$item["rew"];

        $href = "/".$item["rew"];

        $outtext = "

   <div class=\"col-4\">
<a href='$href'>
                    <div class=\"instituce-block\">
                        <div class=\"instituce-block-in bg-opacity black\" style=\"background-image: url(".photo($item["photo"], "medium", "/img/instituce.jpg").")\" >

                            
                            <div class=\"over over2\">
                                <h2>{$item["title"]}</h2>

                                <div class=\"status\">
                                    
                                    
                                </div>
                            </div>
                            
                             <div class=\"btnblock\">
                                    <a class=\"btn a\" href=\"$href\">Zobrazit stránku</a>
                                </div>

                        </div>
                    </div>
                    </a>
                </div>



     ";
        $search = getSerachText($search);
        $outtext = sql::escape($outtext);

        $query = "INSERT INTO tbFulltext set `out` = '$outtext', content = '$search'  ;";

        new sql($query);
    }










// druhy


$query = "SELECT * FROM tbInstituceDruh WHERE isDel = 0 and isActive = 1 ";
$all = new sql($query);
foreach ($all->all() as $item){
    $item["photo"] = $item["photo"];


    $perex = mb_substr(strip_tags($item["perex"]),0, 200, "utf-8");

    $search = strip_tags($item["perex"])." ".$item["rewrite"]." ".$item["title"]." ".$item["title"]." ".$item["rew"];

    $href = "/".$item["rew"];

    $outtext = "



   <div class=\"col-4\">

<a href='$href'>
                    <div class=\"instituce-block\">
                        <div class=\"instituce-block-in   bg-opacity black \"  style=\"background-image: url(".photo($item["photo"], "medium", "/img/instituce.jpg").")\" >

                            <div class=\"over over2\">
                                <h2>{$item["name"]}</h2>
   
                                <div class=\"status\">
                                    
                                    
                                </div>
                        </div>
                        
                          <div class=\"btnblock\">
                                    <a class=\"btn a\" href=\"$href\">Zobrazit instutuce</a>
                                </div>


                        </div>
                    </div>
                    </a>
                </div>



     ";
    $search = getSerachText($search);
    $outtext = sql::escape($outtext);

    $query = "INSERT INTO tbFulltext set `out` = '$outtext', content = '$search'  ;";

    new sql($query);
}





// instituce


$query = "SELECT * FROM tbInstituce WHERE isDel = 0 and isActive = 1 ";
$all = new sql($query);
foreach ($all->all() as $item){
    $item["photo"] = $item["photo"];


    $perex = mb_substr(strip_tags($item["perex"]),0, 200, "utf-8");

    $search = strip_tags($item["perex"])." ".$item["rewrite"]." ".$item["title"]." ".$item["title"]." ".$item["rew"];

    $href = institucedruh::dejRew($item["druh"])."/".$item["rew"];
   // echo $href;

    $outtext = "

   <div class=\"col-4\">

<a href='$href'>
                    <div class=\"instituce-block\">
                        <div class=\"instituce-block-in  bg-opacity black\" style=\"background-image: url(".photo($item["photo"], "medium", "/img/instituce.jpg").")\">

                         
                            <div class=\"over over2\">
                                <h2>{$item["name"]}</h2>

                                <div class=\"status\">
                                    
                                    
                                </div>
                            </div>
   <div class=\"btnblock\">
                                    <a class=\"btn a\" href=\"$href\">Zobrazit pozice</a>
                                </div>

                        </div>
                    </div>
                    </a>
                </div>



     ";
    $search = getSerachText($search);
    $outtext = sql::escape($outtext);

    $query = "INSERT INTO tbFulltext set `out` = '$outtext', content = '$search'  ;";

    new sql($query);
}



// instituce


$query = "SELECT * FROM tbPozice WHERE isDel = 0 and isActive = 1 ";
$all = new sql($query);
foreach ($all->all() as $item){
    $item["photo"] = $item["photo"];


    $perex = mb_substr(strip_tags($item["perex"]),0, 200, "utf-8");

    $search = strip_tags($item["perex"])." ".$item["rewrite"]." ".$item["title"]." ".$item["title"]." ".$item["rew"];

    $href = instituce::dejRew($item["instituce"])."/".$item["rew"];
    // echo $href;

    $outtext = "

   <div class=\"col-4\">

<a href='$href'>
                    <div class=\"instituce-block\">
                        <div class=\"instituce-block-in  bg-opacity black\" style=\"background-image: url(".photo($item["photo"], "medium", "/img/urednik.jpg").")\">


                            <div class=\"over over2\">
                                <h2>{$item["name"]}</h2>

                                <div class=\"status\">
                                    
                                    
                                </div>
                            </div>
                            
                             <div class=\"btnblock\">
                                    <a class=\"btn a\" href=\"$href\">Zobrazit pozici</a>
                                </div>

                        </div>
                    </div>
                    </a>
                </div>



     ";
    $search = getSerachText($search);
    $outtext = sql::escape($outtext);

    $query = "INSERT INTO tbFulltext set `out` = '$outtext', content = '$search'  ;";

    new sql($query);
}






//fly("kolardario@gmail.com", "fulltext platy hotov", "ok");

echo "done";


function getSerachText($search){

    $search =strip_tags($search);
    $search = strtolower($search);
    $search = str_replace("ě", "e", $search);
    $search = str_replace("š", "s", $search);
    $search = str_replace("č", "c", $search);
    $search = str_replace("ř", "r", $search);
    $search = str_replace("ž", "z", $search);
    $search = str_replace("ý", "y", $search);
    $search = str_replace("á", "a", $search);
    $search = str_replace("í", "i", $search);
    $search = str_replace("é", "e", $search);
    $search = str_replace("ó", "o", $search);
    $search = str_replace("ď", "d", $search);
    $search = str_replace("ť", "t", $search);
    $search = str_replace("ň", "n", $search);
    $search = str_replace("ů", "u", $search);
    $search = str_replace("ú", "u", $search);
    $search = sql::escape($search);
    return $search;
}