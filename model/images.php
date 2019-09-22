<?php
session_start();

require 'db.php';

if ($_SESSION['admin'] == 'yes') {

    /*
    Je récupère le nouveau projet et son id
    */
    $currentProject = getLatestProject();

    // Traitement des images à supprimer
    // Images de l'articles
    if (isset($_GET['did']) && $_GET['did'] != "") { 
        deleteImage($currentProject['id'] , ($_GET['did']));
    } 
    // Images sous le texte
    if (isset($_GET['didt']) && $_GET['didt'] != "") {
        deleteImageText($currentProject['id'] , ($_GET['didt']));
    }



    /**
     * IMAGES TITRE PROJET
     */
    if (isset($_FILES['imageGallery']) && !empty($_FILES['imageGallery'])) {
        $nouvelleImage = $_FILES['imageGallery'];
        $nouvelleImageNom = basename($_FILES['imageGallery']['name']);
        uploadImageGalerie($nouvelleImage , FALSE);
        sendImageGalerie($currentProject['id'] , $nouvelleImageNom);
    }

    /**
     * IMAGES GALERIE PROJET
     */
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
        uploadImages($images,FALSE);
    // ... et en base de données après avoir transformé les noms en string
        $imagesNames = implode("," , $_FILES['images']['name']);
        sendImages($currentProject['id'] , $imagesNames);
    }

    
     // IMAGES TEXTE PROJET : Si j'envoie des images pour le texte du projet
     
    if (isset($_FILES['imagesText']) && !empty($_FILES['imagesText'])) {
        $imagesText = [];
        for ($i=0; $i < count($_FILES['imagesText']['name']); $i++) { 
            $imagesText[$i] = [
                'name' => $_FILES['imagesText']['name'][$i],
                'type' => $_FILES['imagesText']['type'][$i],
                'tmp_name' => $_FILES['imagesText']['tmp_name'][$i],
                'error' => $_FILES['imagesText']['error'][$i],
                'size' => $_FILES['imagesText']['size'][$i],
            ];
        }

    // Envoi des images dans le dossier ...
        uploadImages($imagesText,FALSE);

    // ... et en base de données après avoir transformé les noms en string
        $imagesTextNames = implode("," , $_FILES['imagesText']['name']);
        sendImagesText($currentProject['id'] , $imagesTextNames);

    }


    /*
    Je récupère une deuxième fois le nouveau projet mis à jour
    */
    $currentProject = getLatestProject();

    /*
    L'image titre et la nouvelle liste des images du projet
    */
    $imgTitle = $currentProject['imageTitre'];

    $imgList = $currentProject['imagesArticle'];
    $listeImages = explode("," , $imgList); // Conversion en tableau

    /**
     * Et la liste des images placées sous le texte
     */

    $imgTextList = $currentProject['imagesTextArticle'];
    $listeImagesTexte = explode("," , $imgTextList); // Conversion en tableau
    include_once '../view/imagesView.phtml';

    } else {
    header('Location: ../index.php');
}
