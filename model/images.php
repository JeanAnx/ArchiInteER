<?php
session_start();

if ($_SESSION['admin'] == 'yes') {

require_once 'db.php';

    // Si les images qu'on envoie concernent le slider :
    if (isset($_GET['i']) && $_GET['i'] == "s") {
        
    // Traitement > Image du slider à supprimer !! dsid pour delete slider id

        if (isset($_GET['did']) && $_GET['did'] != "") {
            deleteImageSlider(($_GET['dsid']));
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

    header('Location: admin.php?slider=ok');

    }


if (isset($_GET['sliderdelete']) && $_GET['sliderdelete'] != "") {
    // TODO Si l'image à supprimer est une image du slider
}

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
