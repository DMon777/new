$(document).ready(function() {

    $(".main_menu li").hover(function(){

            $(this).children("ul").slideDown(200)},
        function(){
            $(this).children("ul").slideUp(300)
        });


    $("#search input[type=text]").bind('click',function(){
        $(this).animate({
            'width':'300px'
        },1000);
    });

    $("#search input[type=text]").bind('focusout',function(){
        $(this).animate({
            'width':'137px'
        },1000);
    });


});


