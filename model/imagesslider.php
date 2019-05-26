<?php
session_start();

if ($_SESSION['admin'] == 'yes') {

require_once 'db.php';

    // Si les images qu'on envoie concernent le slider :
    if (isset($_GET['images']) && $_GET['images'] == "slider") {

    // Traitement > Image du slider à supprimer

        if (isset($_GET['dsid']) && $_GET['dsid'] != "") {
            deleteImageSlider(($_GET['dsid']));
            header('Location: ../admin.php#imagesSlider');
        }
        
        // Ajout des images Slider
        if (isset($_FILES['imagesSlider']) && !empty($_FILES['imagesSlider'])) {
            $imagesSlider = [];
            for ($i=0; $i < count($_FILES['imagesSlider']['name']); $i++) { 
            
                $imagesSlider[$i] = [
                    'name' => $_FILES['imagesSlider']['name'][$i],
                    'type' => $_FILES['imagesSlider']['type'][$i],
                    'tmp_name' => $_FILES['imagesSlider']['tmp_name'][$i],
                    'error' => $_FILES['imagesSlider']['error'][$i],
                    'size' => $_FILES['imagesSlider']['size'][$i],
                ];
            
            }

        }

        var_dump($_FILES);
        var_dump($_GET);

    // Enregistrement des fichiers images ...
    uploadImagesSlider($imagesSlider);

    // Et envoi en BDD 
    $imagesSlider = implode("," , $_FILES['imagesSlider']['name']);
    sendImagesSlider($imagesSlider);

    header('Location: ../admin.php?slider=ok#imagesSlider');

    }


if (isset($_GET['sliderdelete']) && $_GET['sliderdelete'] != "") {
    // TODO Si l'image à supprimer est une image du slider
}

} else {
    header('Location: ../index.php');

}