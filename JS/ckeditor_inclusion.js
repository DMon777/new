$(document).ready(function() {
    var ckeditor1 = CKEDITOR.replace( 'full_article',{});

    AjexFileManager.init({
        returnTo: 'ckeditor',
        editor: ckeditor1
    });

});