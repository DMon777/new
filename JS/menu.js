$(document).ready(function() {

    $(".main_menu li").hover(function(){

            if($(this).children('ul').length > 0){
                $(this).children('a').click(function(event){
                    event.preventDefault();
                })
            }

            $(this).children("ul").slideDown()},
        function(){
            $(this).children("ul").hide()
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
        if($(this).next().length > 0){
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


    $(".likes_img").bind('click',function(){

        var article_id = $(this).siblings('.article_id').val();
        var that = $(this);
        $.ajax({
            url:'/ajax/method/add_like',
            type:'post',
            data:{article_id:article_id},
            success:function(result){
                if(result == "Голосовать могут только авторизованные пользователи!"){
                    alert(result);
                }
                else{
                    that.siblings('.count_likes').html(result);
                }
            }

        });
    });


});


