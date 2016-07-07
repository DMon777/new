$(document).ready(function(){

    $(".add_comment_button").bind('click',function(event){
        event.preventDefault();

        $(".add_comment_button").css('display','none');
        $("#text_comment").show(300);

        $("span.x").bind('click',function(){
            $("#text_comment").hide();
            $(".add_comment_button").css('display','inline-block');
        });


    });



    $(".answer_button").bind('click',function(){

        $(this).css('display','none');
        $(".answer_form").hide();
        $(".answer_button").show();
        $(this).hide();
        $(this).next().show(300);

        $(".x_answer").bind('click',function(){
            $(".answer_form").hide();
            $(".answer_button").css('display','inline-block');
        });

    })

});