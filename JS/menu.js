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

    $("#menu_image").bind('click',function(){

        $("#adaptive_main_menu").slideToggle(300);

    });

    $("#adaptive_main_menu a").bind('click',function(event){
        if($(this).next().length == 0){
            return true;
        }
        else{
            event.preventDefault();
            $(this).next().slideToggle(200);
        }
    });


    $("#search_image").bind('click',function(){
       $(this).css('display','none');
        $("#adaptive_search_form").css('display','block');

        $("#adaptive_form_close").bind('click',function(){
            $("#adaptive_search_form").css('display','none');
            $("#search_image").css('display','block');
        });

    });



});


