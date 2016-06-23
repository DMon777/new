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
        $("#search_image").slideUp();
        $("#adaptive_search_form").slideDown();
        $("#adaptive_form_close").slideDown();
    });


    $("#adaptive_form_close").bind('click',function(){
        $("#adaptive_search_form").css('display','none');
        $("#adaptive_form_close").css('display','none');
        $("#search_image").css('display','block');
    });


    $("#auth_img").bind('click',function(){

        $("#auth_img").css('display','none');
        $("#auth").slideDown(300);

    });

    $("#auth_close_img").bind('click',function(){
        $("#auth").css('display','none');
        $("#auth_img").slideDown(300);
    })



});


