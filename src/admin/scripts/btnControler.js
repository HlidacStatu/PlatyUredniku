function galDel(BTN){

    BTN.parent().parent().fadeOut(300, function(){
        BTN.parent().parent().remove();
    });
    console.log(BTN.attr("target"));
    $.ajax({type: "POST",
        url: "/admin/core/pager.php",
        data: { module: module, page: "photoDel", source: BTN.attr("source"), target: BTN.attr("target") }
    });


}

function galNote(BTN){


    $(".oknoAccept").parent().fadeOut();
    $(".oknoNote").parent().fadeOut();

    var data = $('form').serializeArray();
    console.log(BTN.attr("target"));
    $.ajax({type: "POST",
        url: "/admin/core/pager.php",
        data: { module: module, page: "photoNoteSave",form: data, source: BTN.attr("source"), target: BTN.attr("target") }
    });


}

$(document).on("click", ".datalineclick",  function(e){

  //  console.log($(this));

    var target  = $(e.target);
    if( target.is('a') ) {
        return true;
    }else{
        console.log("click");
        e.preventDefault();
        $(this).parent().find('.btntrigger').first().trigger('click');
        return false;
    }
});

function lineclick(event, self){

}

function btnPress(BTN){

    for ( instance in CKEDITOR.instances )
        CKEDITOR.instances[instance].updateElement();


    /* pokud je storno vyřešíme ihned */
    if (BTN.attr("do") === "storno"){
        $(".oknoAccept").parent().fadeOut(300, function(){
            $(".oknoAccept").find(".in").html("");
        });
        $(".oknoNote").parent().fadeOut(300, function(){
            $(".oknoNote").find(".in").html("");
        });
        return false;
    }


    /* Validace */
    $(".valid").each(function(){
        $(this).parent().find("input").each(function(){
            //	console.log($(this));
            $(this).trigger("focusout");
            $(this).trigger("change");
            $(this).trigger("keyup");
        });
    });

    var valid = true;
    $(".valid").each(function(){
        console.log($(this).val());
        if (parseInt($(this).val()) === 0){
            valid = false;
        }
    });

    if (BTN.attr("do") === "note"){
        /* zobrazení potvrzovacího malého okna (narozdíl od potvrzovacího má flexibilní výšku) */
        $(".oknoNote").parent().css("display", "flex").hide().fadeIn();
        $(".oknoNote").find(".in").html('<div class="preppendThere"><img src="img/loader2.gif"></div>');
        $.ajax({type: "POST",
            url: "/admin/core/pager.php",
            data: { module: module, page: BTN.attr("page"), form: data, source: BTN.attr("source"), target: BTN.attr("target"), accept: false }
        }).done(function( data ) {
            $(".oknoNote").find(".in").html(data);
            //  $('html,body').animate({ scrollTop: 0 }, 'slow');
            $(".oknoNote").fadeIn();

        });
        return false;
    }

    /* Konec validací */
    if (BTN.hasClass("returnBack")){
        valid = true;
    }
    if (valid === false){
        return false;
    }

    /*skrytí všho co může být zobrazeno (vyskakovací okna)*/
    $(".oknoAccept").parent().fadeOut();
    $(".oknoNote").parent().fadeOut();

    if (BTN.attr("do") === "page"){
        /* přechod na běžnou stránku */

        buildAdminUrl(module, BTN.attr("page"), BTN.attr("target"), BTN.attr("source"));


        $(".content .in").fadeOut();
        $(".content").addClass("loading");
        var data = $('form').serializeArray();
        var editors = [];
        var editornames = [];
        try {
            for (var i in CKEDITOR.instances) {
                (function(i){
                    editornames.push([CKEDITOR.instances[i].name]);
                    editors.push([CKEDITOR.instances[i].getData()]);
                })(i);
            }
        }catch(err) {

        }
        console.log(editors);


        $.ajax({type: "POST",
            url: "/admin/core/pager.php",
            data: { module: module, page: BTN.attr("page"), form: data, editornames: editornames, editors: editors, source: BTN.attr("source"), target: BTN.attr("target") }
        }).done(function( data ) {
            try {
                for (var i in CKEDITOR.instances) {
                    (function(i){
                        CKEDITOR.instances[i].destroy(true);
                    })(i);
                }
            }catch(err) {

            }
            $(".content .in").delay(400).queue( function(next){
                $(this).html(data);
                $(".content .in").fadeTo(400,1);
                $(".content").removeClass("loading");

                next();
            });
            $('html,body').animate({ scrollTop: 0 }, 'slow');
        });
    }
    if (BTN.attr("do") === "del"){
        /* zobrazení potvrzovacího okna */
        $(".oknoAccept").parent().css("display", "flex").hide().fadeIn();
        $(".oknoAccept").find(".in").html('<div class="preppendThere"><img src="img/loader2.gif"></div>');
        $.ajax({type: "POST",
            url: "/admin/core/pager.php",
            data: { module: module, page: BTN.attr("page"), form: data, source: BTN.attr("source"), target: BTN.attr("target"), accept: false }
        }).done(function( data ) {
            $(".oknoAccept").find(".in").html(data);
            // $('html,body').animate({ scrollTop: 0 }, 'slow');
            $(".oknoAccept").fadeIn();
        });
    }



}

/*
 $(document).on("click", ".btn", function(){
 btnPress($(this));
 });*/

$(document).keypress(function(e) {
    if(e.which == 13) {

        var $targ = $(e.target);

        if (!$targ.is("textarea") && !$targ.is(":button,:submit") && !$targ.is("rocketeditor")) {
            btnPress($(".enterSubmit"));
            return false;
        }
        // btnPress($(".enterSubmit"));
    }
});



$(document).on('keydown', function(e){
    if(e.ctrlKey && e.which === 83){
        btnPress($(".enterSubmit"));
        e.preventDefault();
        return false;
    }
    if(e.metaKey && e.which === 83){
        btnPress($(".enterSubmit"));
        e.preventDefault();
        return false;
    }
});



function initMap() {
    var lat =50.772416;
    var lng = 15.429813;
    var defZoom = 13;
    if(  $("input[name='lat']").val() !== ""){
        lat = parseFloat($("input[name='lat']").val());
        defZoom = 13;
    }
    if(  $("input[name='lng']").val() !== ""){
        lng = parseFloat($("input[name='lng']").val());
        defZoom = 13;
    }



    var centerLatLng = {lat: lat, lng: lng};
    var map = new google.maps.Map(document.getElementById('clickmap'), {
        zoom: defZoom,
        center: centerLatLng,
        styles: [
            {
                "featureType": "all",
                "elementType": "all",
                "stylers": [
                    {
                        "hue": "#e7ecf0"
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "on"
                    }
                ]
            },
            {
                "featureType": "landscape.man_made",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#c5cedb"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "all",
                "stylers": [
                    {
                        "saturation": -70
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "simplified"
                    },
                    {
                        "saturation": -60
                    }
                ]
            }
        ]
    });
    console.log(map);
    var marker = new google.maps.Marker({
        position: centerLatLng,
        map: map,
        title: "Bod na mapě",
        icon: '/img/marker.png',
        draggable:true
    });

    function handleEvent(event) {
        $("input[name='lat']").val(event.latLng.lat());
        $("input[name='lng']").val(event.latLng.lng());
    }
    marker.addListener('drag', handleEvent);
    marker.addListener('dragend', handleEvent);

    $("input[name='Lat']").keypress(function(e){
        if ( e.which == 13 ){ e.preventDefault();
            $("#findbygps").trigger("click");}
    });
    $("input[name='Lng']").keypress(function(e){
        if ( e.which == 13 ){ e.preventDefault();
            $("#findbygps").trigger("click");}
    });


    $("#findbygps").click(function(){
        if(  $("input[name='lat']").val() !== "" && $("input[name='lng']").val() !== ""){
            var latlng = new google.maps.LatLng($("input[name='lat']").val(), $("input[name='lng']").val());
            marker.setPosition(latlng);
            map.setCenter(latlng);
            map.setZoom(14);

            $("#findbygps").parent().find(".info").html("Bod byl přemístěn dle zadaných souřadnic");
            setTimeOut(function () {                $("#findbygps").parent().find(".info").html("");            }, 2500);
        }else{
            $("#findbygps").parent().find(".info").html("Nebyla nalezena poloha odpovídající zadaným GPS");
            setTimeOut(function () {                $("#findbygps").parent().find(".info").html("");            }, 2500);


        }
    });

}


function ownerlist(selected, textarea){


    $("#ownerselect option").each(function(){
        $(this).removeAttr("disabled");
    });

    textarea.val("");
    selected.find(".item").each(function(){
        if(textarea.val() == ""){
            textarea.val($(this).attr("id"));
        }else{
            textarea.val(textarea.val() + ";" + $(this).attr("id"));
        }
        $(" #ownerselect option[value='"+$(this).attr("id")+"']").attr("disabled", "true");
    });



    selected.find(".item .fa-times").unbind();
    selected.find(".item .fa-times").click(function(){
        $(this).parent().remove();
        ownerlist(selected, textarea);
    });

}