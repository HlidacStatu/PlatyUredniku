
var obj;
function openFileManager(temp){
    obj = temp;
    $(".coverFile").css("display", "flex").hide().fadeIn();
    $.ajax({type: "POST",url: "/admin/core/filemanager.php"}).done(function( data ) {
        $(".coverFile .in").html(data);
        $(".coverFile .oknoFile .box").unbind();
        $(".coverFile .oknoFile .box").click(function(){

            if( typeof(CKEDITOR) !== "undefined" )

            obj.find("input.a").val($(this).find(".link").html());
            obj.find("input.a").trigger("change");
            obj.find(".nahled").css("background-image","url('"+($(this).find(".info .icon").html())+"')")  ;
            $(".cover").fadeOut();
        });

        $(".coverFile .oknoFile .close").unbind();
        $(".coverFile .oknoFile .close").click(function(){
            $(".cover").fadeOut();
        });
    });
}


function openFileManager2(temp){
    obj = temp;
    $(".coverFile").css("display", "flex").hide().fadeIn();
    $.ajax({type: "POST",url: "/admin/core/filemanager.php?ckedit"}).done(function( data ) {
        $(".coverFile .in").html(data);
        $(".coverFile .oknoFile .box").unbind();
        $(".coverFile .oknoFile .box").click(function(){
            //  console.log($(this).find(".type").html());
            if($(this).find(".type").html() === "obr"){

                /*      var name = obj.getSelection().getSelectedText();
                 if(!name || 0 === name.length ){*/
                obj.insertHtml("<img src='"+$(this).find(".link").html()+"' >");
                /*    }else{
                 obj.insertHtml("<a href='"+$(this).find(".link").html()+"' >"+name+"</a>");
                 }*/

            }else{

                var name = obj.getSelection().getSelectedText();
                if(!name || 0 === name.length ){
                    name = $(this).find(".name").html();
                }
                obj.insertHtml("<a href='"+$(this).find(".link").html()+"' >"+name+"</a>");
            }
            $(".coverFile .in").html("");
            //   obj.insertHtml("<img src='"+$(this).find(".link").html()+"' >");
            $(".coverFile").fadeOut();
        });
        $(".coverFile .oknoFile .close").unbind();
        $(".coverFile .oknoFile .close").click(function(){
            $(".cover").fadeOut();
        });
    });
}




$(document).on("dragenter", ".fileUpload", function(e){
    e.stopPropagation();
    e.preventDefault();
    $(this).addClass("enter");
});
$(document).on("dragover", ".fileUpload", function(e){
     e.stopPropagation();
     e.preventDefault();
});
$(document).on("drop", ".fileUpload", function(e){
    $(this).removeClass("enter");
    e.preventDefault();
    var files = e.originalEvent.dataTransfer.files;
    handleFileUpload(files,$(this).parent());
});

$(document).on('dragenter', function (e) {
    e.stopPropagation();
    e.preventDefault();
});
$(document).on('dragover', function (e) {
  e.stopPropagation();
  e.preventDefault();
});
$(document).on('drop', function (e) {
    e.stopPropagation();
    e.preventDefault();
});


function sendFileToServer(formData, obj){
    var uploadURL ="/admin/core/upload.php"; //Upload URL
    var extraData ={ }; //Extra Data.
    var jqXHR=$.ajax({
        xhr: function() {
            var xhrobj = $.ajaxSettings.xhr();
            if (xhrobj.upload) {
                xhrobj.upload.addEventListener('progress', function(event) {
                    var percent = 0;
                    var position = event.loaded || event.position;
                    var total = event.total;
                    if (event.lengthComputable) {
                        percent = Math.ceil(position / total * 100);
                    }
                    obj.find(".nahled .notify").css("opacity","0.9");
                    obj.find(".nahled .notify").html(percent+"%");
                    obj.find(".nahled .notify").css('background-image','none');
                    if(percent === 100){
                        obj.find(".nahled .notify").css("opacity","1");
                        obj.find(".nahled .notify").html("");
                        obj.find(".nahled .notify").css('background-image','url(/admin/img/loader2.gif)');
                    }


                }, false);
            }
        return xhrobj;
        },
    url: uploadURL,
    type: "POST",
    contentType:false,
    processData: false,
    cache: false,
    data: formData,
    dataType: "json",
    success: function(data){

            console.log(data);
	obj.find(".nahled .notify").css("opacity","0");
        obj.find(".nahled").css("background-image","url('"+(data["icon"])+"')")  ;
        obj.find("input.a").val(data["link"]);
        obj.find("input.type").val(data["type"]);
        obj.find("input.name").val(data["name"]);

        console.log(data["link"]);
        console.log( obj.find("input.a"));
	obj.find("input.a").trigger("change");
        obj.find("input.return").val(data["id"]);
        obj.find("input.return").trigger("change");
        }
    }); 
}

function handleFileUpload(files,objDrag){
   for (var i = 0; i < files.length; i++){
        var fd = new FormData();
        fd.append('file', files[i]);
 	fd.append('addData', objDrag.find(".addData").val());
        sendFileToServer(fd, objDrag);
 
   }
}






function plotDragItems(name){

    $("#"+name).val("");
    $(".sortable"+name+" .item").each(function(){
        if ( $("#"+name).val() === ""){
            $("#"+name).val( $(this).find("input").val()) ;
        }else{
            $("#"+name).val( $("#"+name).val()+";"+$(this).find("input").val() );
        }

    });

}




function plotCenikItems(name){
if(name === "terminy"){

    $('.datefrom').each(function(){
        $(this).datepicker( { changeYear: false, dateFormat: 'dd.mm.yy'});
    });
    $('.dateto').each(function(){
        $(this).datepicker( { changeYear: false, dateFormat: 'dd.mm.yy'});
    });

}else{

    $('.datefrom').each(function(){
        $(this).datepicker( { changeYear: false, dateFormat: 'dd.mm.'});
    });
    $('.dateto').each(function(){
        $(this).datepicker( { changeYear: false, dateFormat: 'dd.mm.'});
    });

}




    $(".active .option").unbind("click");
    $(".active .option").click(function(){
        if ($(this).parent().find(".value").val() === "0"){
            $(this).parent().find(".value").val(1);
            $(this).find(".in").removeClass("val0");
            $(this).find(".in").addClass("val1");
            $(this).find(".in").html("Ano");
        }else{
            $(this).parent().find(".value").val(0);
            $(this).find(".in").removeClass("val1");
            $(this).find(".in").addClass("val0");
            $(this).find(".in").html("Ne");
        }
        $(this).parent().find(".value").trigger("change");
    });

    $(".season .option").unbind("click");
    $(".season .option").click(function(){
        if ($(this).parent().find(".value").val() === "0"){
            $(this).parent().find(".value").val(1);
            $(this).find(".in").removeClass("val0");
            $(this).find(".in").addClass("val1");
            $(this).find(".in").html('<i class="fa fa-snowflake-o"></i> Zima');
        }else{
            $(this).parent().find(".value").val(0);
            $(this).find(".in").removeClass("val1");
            $(this).find(".in").addClass("val0");
            $(this).find(".in").html('<i class="fa fa-sun-o"></i> Léto');
        }
        $(this).parent().find(".value").trigger("change");
    });


    $(".sortable"+name+" input").unbind("change");
    $(".sortable"+name+" input").change(function(){
        plotCenikItems(name);
        });
    $(".sortable"+name+" select").unbind("change");
    $(".sortable"+name+" select").change(function(){
        plotCenikItems(name);
    });

    var ok = false;

    $("#"+name).val("");
    var array = [];
    $(".sortable"+name+" .item").each(function(){
        var item = {};
        item ["datefrom"] = $(this).find(".datefrom").val();
        item ["dateto"] = $(this).find(".dateto").val();
        item ["season"]= $(this).find(".season .value").val();
        item ["active"] = $(this).find(".active .value").val();


 if (       $(this).find(".cenaDen").length > 1 ){

            if ($(this).find(".cenaDen").val().length > 3) {
                var ok1 = true;
            }
            if ($(this).find(".datefrom").val().length > 3) {
                var ok2 = true;
            }
            if ($(this).find(".dateto").val().length > 3) {
                var ok3 = true;
            }
            if (ok1 == true && ok2 == true && ok3 == true) {
                ok = true;
            }
        }else{
     ok = true;
 }

        item ["cenaDen"] = $(this).find(".cenaDen").val();
        item ["cenaTyden"] = $(this).find(".cenaTyden").val();

        item ["parameter"] = $(this).find(".parameter").val();
        item ["value"] = $(this).find(".value").val();


        item ["target"] = $(this).find(".target").val();
        item ["type"] = $(this).find(".type").val();
        item ["label"] = $(this).find(".label").val();

        item ["osobaDenOd"] = $(this).find(".osobaDenOd").val();
        item ["osobaDenDo"] = $(this).find(".osobaDenDo").val();
        item ["osobaTydenOd"] = $(this).find(".osobaTydenOd").val();
        item ["osobaTydenDo"] = $(this).find(".osobaTydenDo").val();
        item ["apartmanDenOd"] = $(this).find(".apartmanDenOd").val();
        item ["apartmanDenDo"] = $(this).find(".apartmanDenDo").val();
        item ["apartmanTydenOd"] = $(this).find(".apartmanTydenOd").val();
        item ["apartmanTydenDo"] = $(this).find(".apartmanTydenDo").val();
        array.push(item);

    });


    var validparent =   $("#"+name).parent();
    if (ok == false){
        validparent.find(".valid").val(0);
        validparent.find(".warning").addClass("active");
        validparent.find(".smallWarGreen").fadeOut();
        validparent.find(".smallWarRed").fadeIn();
        validparent.find(".valid").val(0);
    }else{
        validparent.find(".valid").val(1);
        validparent.find(".warning").removeClass("active");
        validparent.find(".smallWarGreen").fadeIn();
        validparent.find(".smallWarRed").fadeOut();
        validparent.find(".valid").val(1);
    }

    $("#"+name).val(JSON.stringify(array));
}