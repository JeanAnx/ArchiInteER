<?php

require_once 'db.php';

var_dump($_FILES);

/*
Je récupère le nouveau projet et son id
*/
$currentProject = getLatestProject();
var_dump($currentProject);

/*
Et la liste des images
*/
$imgTitle = $currentProject['imageTitre'];

$imgList = $currentProject['imagesArticle'];
$listeImages = explode(",",$imgList['imagesArticle']); // Conversion en tableau

/***
 * Si j'envoie un File pour l'image titre :
 */
if (isset($_FILES['imageGallery']) && !empty($_FILES['imageGallery'])) {
    $nouvelleImage = $_FILES['imageGallery'];
    $nouvelleImageNom = basename($_FILES['imageGallery']['name']);
    var_dump($nouvelleImageNom);
    uploadImageGalerie($nouvelleImage);
    sendImageGalerie($currentProject['id'] , $nouvelleImageNom);
}

    include_once '../view/imagesView.phtml';




