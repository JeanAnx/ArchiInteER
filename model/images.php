<?php
session_start();

require 'db.php';

var_dump($_GET);

if ($_SESSION['admin'] == 'yes') {

    // Traitement d'une image à supprimer
    if (isset($_GET['did']) && $_GET['did'] != "") {
        deleteImage($currentProject['id'] , ($_GET['did']));
    }

    /*
    Je récupère le nouveau projet et son id
    */
    $currentProject = getLatestProject();

    /**************************************************************
     * IMAGES PROJETS : Si j'envoie un File pour l'image titre :
     */
    if (isset($_FILES['imageGallery']) && !empty($_FILES['imageGallery'])) {
        $nouvelleImage = $_FILES['imageGallery'];
        $nouvelleImageNom = basename($_FILES['imageGallery']['name']);
        var_dump($nouvelleImageNom);
        uploadImageGalerie($nouvelleImage);
        sendImageGalerie($currentProject['id'] , $nouvelleImageNom);
    }

    if (isset($_FILES['images']) && !empty($_FILES['images'])) {

        $images = [];

        for ($i=0; $i < count($_FILES['images']['name']); $i++) { 
        
            $images[$i] = [
                'name' => $_FILES['images']['name'][$i],
                'type' => $_FILES['images']['type'][$i],
                'tmp_name' => $_FILES['images']['tmp_name'][$i],
                'error' => $_FILES['images']['error'][$i],
                'size' => $_FILES['images']['size'][$i],
            ];
        
        }

    // Envoi des images dans le dossier ...
        uploadImages($images);

    // ... et en base de données après avoir transformé les noms en string
        $imagesNames = implode("," , $_FILES['images']['name']);
        var_dump($imagesNames);
        sendImages($currentProject['id'] , $imagesNames);

    }


    /*
    Je récupère une deuxième fois le nouveau projet mis à jour
    */
    $currentProject = getLatestProject();

    /*
    Et la nouvelle liste des images
    */
    $imgTitle = $currentProject['imageTitre'];

    $imgList = $currentProject['imagesArticle'];
    $listeImages = explode("," , $imgList); // Conversion en tableau

        include_once '../view/imagesView.phtml';

    } else {
    header('Location: ../index.php');
}
