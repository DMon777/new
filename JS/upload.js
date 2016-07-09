$(document).ready(function(){
        var button  = $("#avatar"),interval,file;
   new Ajax_upload(button,{
       action:"ajax/method/upload_avatar",
       data:{file:"file"},
       name:"avatar",
       onComplete:function(file,response){/* response - ответ от сервера  */

           response = JSON.parse(response);

           $(".avatar_error").text('').append(response.answer);
           if(response.answer == "ошибка загрузки файла,не допустимое расширение файлов!!!"){
               return false;
           }
           if(response.answer == "ошибка загрузки файла,файл слишком большой!!!"){
               return false;
           }
           else{
               $("#avatar").attr('src','images/avatars/'+response.file);
           }
       }

   });



});