$(document).ready(function(){

    $("#auth_button").bind('click',function(){

        var login = $("[name=login]").val();
        var password = $("[name=password]").val();

        $.ajax({
            url:'ajax/method/auth',
            type:'post',
            data:{login:login,password:password},
            success:function(result){
                alert(result)
                if(result == 'поля должны быть заполнены!!!' || result == 'неверный логин или пароль!'){
                    $(".auth_error_message").fadeOut();
                    $(".auth_error_message").text(result);
                    $(".auth_error_message").fadeIn();
                }
                else{
                    $("#auth").css('display','none');
                    $("#header_background").prepend("<div id = 'authorized'><p>"+result+"</p><p><a href='/edit_profile'> редактировать профиль</a> </p>  </div>")

                }
            }
        });

    })

})