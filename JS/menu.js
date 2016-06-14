$(document).ready(function() {

    $(".main_menu li").hover(function(){

            $(this).children("ul").slideDown(200)},
        function(){
            $(this).children("ul").slideUp(300)
        });

});


