'use strict';

$('document').ready(function() {

    // Installation du WYSIWYG sur chaque champ textarea
    $("textarea").each(function(){
        console.log($(this));
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


if (document.getElementById('successMessage') != null) {
	$message = document.getElementById('successMessage');
	$message.style.transition = "all 0.5s ease";
	setTimeout(function () {
		$message.style.opacity = "0";
	} , 3000)
	setTimeout(function () {
		$message = document.getElementById('successMessage');
		$message.style.transform = "scale(0)";
		$message.style.margin = "0";
	} , 3500)
        }



})
