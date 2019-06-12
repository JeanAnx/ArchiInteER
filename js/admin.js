'use strict';

$('document').ready(function() {

    // Installation du WYSIWYG sur chaque champ textarea
    console.log($('textarea'));
    $('textarea').each(function() {
        new FroalaEditor('#' + $(this).attr('id'), {toolbarInline: false , placeholderText: ''});
        console.log($(this).attr('id'));
    });


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
