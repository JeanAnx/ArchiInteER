'use strict';

$('document').ready(function() {

    // Installation du WYSIWYG sur chaque champ textarea
    $("textarea").each(function(){
        $(this).summernote();
    });

    // Message de confirmation sur le bouton de suppression de projet
    $('#buttonDeleteProject').click(function(e) {
        if (confirm('Attention, la suppression du projet est définitive. Continuer ?')){
            return true;
        } else {
            return false;
        };
    })


if ($('.messages') != null) {
    const messagesList = document.getElementsByClassName('messages');
    console.log(messagesList);
    for (let index = 0; index < messagesList.length; index++) {
        let element = messagesList[index];
        element.style.transition = "all 0.5s ease";
        setTimeout(function () {
            element.style.opacity = "0";
        } , 3000)
        setTimeout(function () {
            $message = document.getElementById('successMessage');
            $message.style.transform = "scale(0)";
            $message.style.margin = "0";
        } , 3500)
    }
        }


})
