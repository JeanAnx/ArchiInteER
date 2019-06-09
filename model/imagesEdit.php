<?php
session_start();

/**
 * FICHIER A MODIFIER POUR L'EDITION DE PROJET
 */

require 'db.php';

var_dump($_GET);
$theProject = getProjectById($_POST['pid']);

if ($_SESSION['admin'] == 'yes') {

    // Traitement d'une image à supprimer
    if (isset($_GET['did']) && $_GET['did'] != "") {
        deleteImage($theProject['id'] , ($_GET['did']));
    }

    /**************************************************************
     * IMAGES PROJETS : Si j'envoie un File pour l'image titre :
     */
    if (isset($_FILES['imageGallery']) && !empty($_FILES['imageGallery'])) {
        $nouvelleImage = $_FILES['imageGallery'];
        $nouvelleImageNom = basename($_FILES['imageGallery']['name']);
        var_dump($nouvelleImageNom);
        uploadImageGalerie($nouvelleImage);
        sendImageGalerie($theProject['id'] , $nouvelleImageNom);
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
        sendImages($theProject['id'] , $imagesNames);

    }

    header('Location: projectEdit.php?pid=' . $theProject['id']);

    } else {

    header('Location: ../index.php');

}
