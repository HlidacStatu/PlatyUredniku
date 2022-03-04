

/*
 Checkbox replace

 Dario Kolar
 NETservis 2015

 api.dev.netservis.cz


 */


$(document).ready(function(){
    checkboxreplace();
    radioreplace();
});

function checkboxreplace(){

    var i = 0;

    $(".checkbox-replace").each(function(){

        $(this).hide();
        $(this).addClass("cb-"+i);
        $(this).after("<span class='checkbox-replaced a cb-"+i+"' name='cb-"+i+"'></span>");

        if( $(this).prop('checked') ){

            $(".checkbox-replaced.cb-"+i).addClass("checked");

        }

        if( $(this).prop('disabled') ){

            $(".checkbox-replaced.cb-"+i).addClass("disabled");

        }

        $('label[for="'+ $(this).attr('id') +'"]').unbind();
        $('label[for="'+ $(this).attr('id') +'"]').addClass("cb-"+i);
        $('label[for="'+ $(this).attr('id') +'"]').attr("for", "");
        $('label.cb-'+ i ).click(function(){

            $(".checkbox-replaced."+$(this).attr("class")).trigger("click");


        });

        i++;
    });

    $(".checkbox-replaced").unbind();
    $(".checkbox-replaced").click(function(){

        if($(this).hasClass("disabled")){
            return false;
        }

        if($(this).hasClass("checked")){

            $(this).removeClass("checked");
            $(".checkbox-replace."+$(this).attr("name")).prop("checked",false);
            $(".checkbox-replace."+$(this).attr("name")).trigger("change");

        }else{

            $(this).addClass("checked");
            $(".checkbox-replace."+$(this).attr("name")).prop("checked",true);
            $(".checkbox-replace."+$(this).attr("name")).trigger("change");
        }

    });


}



function radioreplace(){

    var i = 0;

    $(".radio-replace").each(function(){


        $(this).hide();
        $(this).addClass("rb-"+i);
        $(this).after("<span class='radio-replaced a rb-"+i+" rb-name-"+$(this).attr("name")+"' group='"+$(this).attr("name")+"' name='rb-"+i+"'></span>");

        if( $(this).prop('checked') ){

            $(".radio-replaced.rb-"+i).addClass("checked");

        }

        if( $(this).prop('disabled') ){

            $(".radio-replaced.rb-"+i).addClass("disabled");

        }

        $('label[for="'+ $(this).attr('id') +'"]').unbind();
        $('label[for="'+ $(this).attr('id') +'"]').addClass("rb-"+i);
        $('label[for="'+ $(this).attr('id') +'"]').click(function(){

            $(".radio-replaced."+$(this).attr("class")).trigger("click");

        });

        i++;
    });

    $(".radio-replaced").unbind();
    $(".radio-replaced").click(function(){

        if($(this).hasClass("disabled")){
            return false;
        }

        if($(this).hasClass("checked")){


        }else{
            console.log($('.radio-replaced.rb-name-'+ $(this).attr('group') ));
            $('.radio-replaced.rb-name-'+ $(this).attr('group')).removeClass("checked");

            $(this).addClass("checked");
            $(".radio-replace."+$(this).attr("name")).prop("checked",true);
        }

    });


}