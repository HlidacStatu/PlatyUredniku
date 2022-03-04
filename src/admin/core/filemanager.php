<?php
require_once dirname(__FILE__).'/load.php';
/*
 * 
 * Mini filemanager
 */

?>
<div class="fileSpace">
    <?php
    $test = "filemanagerinput";
    echo "<div class='fileupload'><input type='file' class=fileClick id='fileClick{$test}' style='display:none' multiple accept=\"/*\">
                        <div class='nahled fileUpload a' style='background-image: url(/admin/img/upload.png)' onclick='$(this).parent().find(\".fileClick\").trigger( \"click\" );'>
                            <div class='notify a'></div>
                        </div>

                 <div class='imageBtn a fileNew' onclick='$(this).parent().find(\".fileClick\").trigger(\"click\");' >Nahrát nový</div>

                            <input type=hidden name={$test} id={$test} value='' placeholder='' class='a'>
                            <input type=hidden name='{$test}type' id='{$test}type' value='' placeholder='' class='type'>
                            <input type=hidden name='{$test}name' id='{$test}name' value='' placeholder='' class='name'>
                                <script>
                                
                                console.log('test');
                                    $('#{$test}').unbind();
                                    $('#{$test}').change(function(){
                                        console.log($(this).val());
                                        console.log( $(this).parent());
                                    //    $(this).parent().after('<div class=\"box file a\" ><div class=\"icon\" style=\"background-image: url('+$(this).val()+')\"></div><div class=\"data\"><div class=\"name\">'+$(this).val().replace('/files/','')+'</div></div><div class=\"info\"><div class=link>'+$(this).val()+'</div></div></div>');
                                    //    $(this).parent().parent().find('.fileUpload').css('background-image','url(img/upload.png)');

                                     
                                            ";
    if(isset($_GET["ckedit"])){

        echo ' 
            //  console.log($(this).find(".type").html());
            if($(\'#'.$test.'type\').val() === "obr"){

                obj.insertHtml("<img src=\'"+$(\'#'.$test.'\').val()+"\' >");
               

            }else{

                var name = obj.getSelection().getSelectedText();
                if(!name || 0 === name.length ){
                    name = $(\'#'.$test.'name\').val();
                }
                obj.insertHtml("<a href=\'"+$(\'#'.$test.'\').val()+"\' >"+name+"</a>");
            }
            $(".coverFile .in").html("");
            //   obj.insertHtml("<img src=\'"+$(this).find(".link").html()+"\' >");
            $(".coverFile").fadeOut();
        });';
       /* echo "
            $(".coverFile .oknoFile .box").unbind();
                                        $(".coverFile .oknoFile .box").click(function(){

        console.log($(this).find(\".type\").html());
    if($(this).find(\".type\").html() === \"obr\"){
         obj.insertHtml(\"<img src='\"+$(this).find(\".link\").html()+\"' >\"); 
    }else{
       obj.insertHtml(\"<a href='\"+$(this).find(\".link\").html()+\"' >\"+$(this).find(\".name\").html()+\"</a>\"); 
    }
     $(".cover").fadeOut();
                                        });
    "; */
    }else{ echo "
                                            obj.find(\"input.a\").val($(this).find(\".link\").html());
                                            obj.find(\"input.a\").trigger(\"change\");
                                            obj.find(\".nahled\").css(\"background-image\",\"url('\"+($(this).find(\".link\").html())+\"')\")  ;
                                            
                                             $(\".cover\").fadeOut();
                                        });
                                            ";} echo "
                                           
                                   
                                    $('#fileClick{$test}').unbind();
                                    $('#fileClick{$test}').change(function(event){
                                        var files = event.target.files;
                                        handleFileUpload(files,$(this).parent());
                                    });
                               </script>

</div>

                    ";

    ?>
                    <?php echo files::dejList(1); ?>
                </div> 
                <script>
                 $(".fileSpace .box").unbind("click");
            </script>