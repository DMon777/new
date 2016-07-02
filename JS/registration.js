$(document).ready(function(){

   $("#login").bind('focusout',function(){

       var login = $(this).val();

       $.ajax({
           url:'ajax/method/validate_login',
           type:'post',
           data:{login:login},
           success:function(result){
               if(result.length > 0){
                   $(".login_error").text(result);
               }
               else{
                   $(".login_error").text('');
               }
           }
       });
   });


    $("#email").bind('focusout',function(){

        var email = $(this).val();

        $.ajax({
            url:'ajax/method/validate_email',
            type:'post',
            data:{email:email},
            success:function(result){
                if(result.length > 0){
                    $(".email_error").text(result);
                }
                else{
                    $(".email_error").text('');
                }
            }
        });
    });

    $("#password").bind('focusout',function(){

        var password = $(this).val();
        if(password.length < 5 ){
            $(".password_error").text("пароль дожден быть длиннее 5-ти символов");
        }
        else{
            $(".password_error").text(" ");
        }

    });

    $("#confirm_password").bind('focusout',function(){

        var confirm_password = $(this).val();
        var password = $("#password").val();

        if(confirm_password != password){
            $(".confirm_password_error").text("пароли не совпадают!!!");
        }
        else{
            $(".confirm_password_error").text(" ");
        }

    });

    $("#captcha_field").bind('focusout',function(){

        var captcha = $(this).val();

        $.ajax({
            url:'ajax/method/validate_captcha',
            type:'post',
            data:{captcha:captcha},
            success:function(result){
                if(result.length > 0){
                    $(".captcha_error").text(result);
                }
                else{
                    $(".captcha_error").text(' ');
                }
            }
        });
    });


});