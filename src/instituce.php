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


    <div class="block topblock bg-opacity" style="background-image: url(/img/instituce.jpg);">


            <div class="block-in">
                <h1>
                Instituce
                </h1>
                <a class="btn a csvbutton" href="/do/all-csv"><i class="fa fa-file-excel-o"></i> Stáhnout vše jako *.csv</a>




        </div>
    </div>

    <?php  require_once dirname(__FILE__) . '/instituce-list.php'; ?>

<?php  require_once dirname(__FILE__) . '/layout/bottom.php'; ?>



</div>
<!-- /#page -->
</body>

</html>
