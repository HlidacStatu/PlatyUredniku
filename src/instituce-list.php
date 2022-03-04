<div class="block institucebloky">
    <div class="block-in">

        <?php
        $statusy = instituce::statusy();
        $instituce = new sql("select * from tbInstituceDruh where isActive = 1 and isDel = 0 order by ownOrder");
        foreach ($instituce->all() as $m){

            ?>

            <div class="col-3">
<a href="<?=$m["rew"];?>">
                <div class="instituce-block">
                    <div class="instituce-block-in status-<?=$m["status"]; ?> bg-opacity black" style="background-image: url(<?=photo($m["photo"], "medium", "/img/instituce.jpg"); ?>);">


<div class="over">
                            <h2><?=$m["name"];?></h2>
</div>
                            <div class="status">


                                <svg width="75%" viewBox="0 0 42 42" class="donut" style="margin: 0 auto; display:block;">
                                    <circle class="donut-hole" cx="21" cy="21" r="15.91549430918954" fill="transparent"></circle>
                                    <circle class="donut-ring" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#585858" stroke-width="3"></circle>





                                <?php

                                $st = array(1 => 0, 2=> 0, 3 => 0);
                            $stcelkem = 0;

                                $statusy = instituce::statusy();
                                $instituce = new sql("select * from tbInstituce where isActive = 1 and isDel = 0 and druh = {$m["id"]} order by ownOrder");
                                foreach ($instituce->all() as $i){
                                    $st[$i["status"]]++;
                                }

                              //  echo_array($st);
                                $tmp = "";
                                foreach ($st as $key => $val){
                                    $tmp .=  "<span class='part'><span class='info info$key'></span> &nbsp;<strong>$val</strong> </span>".$statusy[$key]." <br>";


                                    $st[$key] = $val;
                                    $stcelkem += $val;

                                }


                                $st[1] = ((100/$stcelkem) * $st[1]);
                                $st[2] = ((100/$stcelkem) * $st[2]);
                                $st[3] = ((100/$stcelkem) * $st[3]);

                                ?>




         <?php if($st[1] != 0){ ?>                           <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#67b117" stroke-width="3" stroke-dasharray="<?=$st[1]; ?> <?=$st[2]+$st[3]; ?>" stroke-dashoffset="25"></circle> <?php } ?>
                                    <?php if($st[2] != 0){ ?>          <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#585858" stroke-width="3" stroke-dasharray="<?=$st[2]; ?> <?=$st[1]+$st[3]; ?>" stroke-dashoffset="<?=(100-($st[1])+25); ?>"></circle><?php } ?>
                                    <?php if($st[3] != 0){ ?>        <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#b1173b" stroke-width="3" stroke-dasharray="<?=$st[3]; ?> <?=$st[1]+$st[2]; ?>" stroke-dashoffset="<?=(100-($st[1]+$st[2])+25); ?>"></circle><?php } ?>




                                </svg>

<?php if( $st[1] == 100){ ?><div class="largemark green"><i class="fa fa-check"></i></div>  <?php   }?>
<?php if( $st[3] == 100){ ?> <div class="largemark red"><i class="fa fa-times"></i></div> <?php   }?>

                                <?=$tmp; ?>



</div>

                        <div class="btnblock">
                            <a class="btn a" href="<?=$m["rew"];?>">Zobrazit instituce</a>
                        </div>


                    </div>
                </div>
</a>
            </div>


            <?
        }

        ?>
        <div class="clear"></div>
        <br>
        <br>
        <br>
    </div></div>

