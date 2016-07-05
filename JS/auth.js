$(document).ready(function(){

    $("#auth_button").bind('click',function(){

        var login = $("[name=login]").val();
        var password = $("[name=password]").val();

        $.ajax({
            url:'/ajax/method/auth',
            type:'post',
            data:{login:login,password:password},
            success:function(result){
                if(result == 'поля должны быть заполнены!!!' || result == 'неверный логин или пароль!'){
                    $(".auth_error_message").hide().fadeIn(500).text(result);
                }
                else{
                    $("#auth").css('display','none');
                    $("#header_background").prepend("<div id = 'authorized'>" +"<p>Добро пожаловать на сайт</p>"+
                        "<p>"+result+"</p><p><a href='/edit_profile'> редактировать профиль</a> </p> " +
                        "<p><a href='/logout'>exit</a> </p>" +
                        " </div>")
                }
            }
        });

    })

})