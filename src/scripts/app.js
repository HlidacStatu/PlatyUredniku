

$(document).ready(function(){

    $(".scrollthere").each(function(){

        $(".anchorNavIn ol").append('<li><a href="#'+$(this).attr("id")+'" title="'+$(this).attr("data")+'">'+$(this).attr("data")+'</a> </li>');
    });

    $(".anchorNavIn ol a").click(function(event){
        event.preventDefault();
        //console.log($('#'+this.hash.substring(1)));
        $('html,body').animate({scrollTop:$('#'+this.hash.substring(1)).offset().top - 120}, 1200);
    });


    $(".anchorNavIn p a").click(function(event){
        if($(this).hasClass("nolink")){

        }else{

            event.preventDefault();
            //console.log($('#'+this.hash.substring(1)));
            $('html,body').animate({scrollTop:$('#'+this.hash.substring(1)).offset().top - 120}, 1200);
        }
    });


});


$(window).scroll(function() {


    $('.movingBcgSlow').css('background-position', 'center -'+($(this).scrollTop() * 0.5)+'px');


if($(window).scrollTop() > 50){
    $('body').addClass('scroll');
}else{
    $('body').removeClass('scroll');
}


    if($(window).scrollTop() > 92){
        $('body').addClass('scrollAnchorNav');
    }else{
        $('body').removeClass('scrollAnchorNav');
    }


    if($(window).scrollTop() > 905){
        $('body').addClass('bookingBarOn');
    }else{
        $('body').removeClass('bookingBarOn');
    }



});