<!DOCTYPE html>
<html>
<head>

  <?php

  $meta["title"] = "Platy top úředníků";
  $meta["description"] = "";
  $meta["keywords"] = "";
  require_once dirname(__FILE__) . '/layout/head.php'; ?>


</head>

<body class="">

<div id="page">

<?php  require_once dirname(__FILE__) . '/layout/top.php'; ?>


    <div class="block topblock bg-opacity" style="background-image: url(/img/snemovna.jpg);">



            <div class="block-in">
                <h1>
                Hledání
                </h1>



            </div>

    </div>

    <?php

    $vyraz = sql::escape($_GET["q"]);

    ?>

    <div class="block institucebloky">
        <div class="block-in">

            <br>
            <br>
            <form class="hledanitop hledani2" action="/hledani" method="get">
                <input name="q" value="<?=$vyraz; ?>" placeholder="hledejte...">
                <button type="submit" class="btn"><i class="fa fa-search"></i></button>

            </form>
            <br>
            <br>
            <?php
            $search =htmlspecialchars(sql::escape($vyraz));
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
            $search = "+".$search."*";




            $query= "select *,  MATCH(`content`) AGAINST ('".$search."' IN BOOLEAN MODE) from tbFulltext where   MATCH(`content`) AGAINST ('".$search."' IN BOOLEAN MODE)>0 order by MATCH(`content`) AGAINST ('".$search."' IN BOOLEAN MODE) desc limit 0, 100 ";
           // echo $query;
            $data = new sql($query);

            $naslo = false;

            ?>  <?
                $i=0;
                foreach ($data->all() as $zaznam){
                    $i++;
                    $naslo = true;

                    echo $zaznam["out"];


                    ?>




                <?
            }

            ?>
            <div class="clear"></div>
            <br>
            <br>
            <br>
        </div>


        <div class="block institucebloky">
            <div class="block-in" style="text-align: center;">

                <br>
                <br>
<?php if(!$naslo){ ?>
     <h2>Nenašli jste pozici, kterou jste hledali?</h2>
<br>
    <div class="clear"></div>
<a href="/instituce" class="btn">Procházejte instituce</a>
                <?php } ?>
                <h2></h2>
                <br>
                <br>



                <div class="clear"></div>
                <br>
                <br>
                <br>
            </div></div>


    </div>
<?php  require_once dirname(__FILE__) . '/layout/bottom.php'; ?>


<!-- /#page -->
</body>

</html>
