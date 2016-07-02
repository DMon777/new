$(document).ready(function(){

   $("#login").bind('focusout',function(){

       var login = $(this).val();

       $.ajax({
           url:'ajax/method/validate_login',
           type:'post',
           data:{login:login},
           success:function(result){
               if(result.length > 0){
                   alert('больше 0');
                   $(".login_error").text(result);
                   $("[name=registration]").bind('click',function(){
                       $("#reg_form").bind('submit',function(){
                           return false;
                       })
                   })

               }
               else{
                   alert('меньше 0');
                   $(".login_error").text('');
                   $("[name=registration]").bind('click',function(){
                       alert('hillo')
                       $("#reg_form").submit;
                   })
               }

           }
       });


   })



});