<?php 
session_start();

if (isset($_SESSION['admin']) && $_SESSION['admin'] == 'yes') {

    require 'model/db.php';

        var_dump($_GET);
        $theProject = getProjectById($_GET['pid']);

        if ($_SESSION['admin'] == 'yes') {

            // Traitement d'une image à supprimer
            if (isset($_GET['did']) && $_GET['did'] != "") {
                deleteImage($theProject['id'] , ($_GET['did']));
            }

            // IMAGES PROJETS : Si j'envoie un File pour l'image titre :
            if (isset($_FILES['imageGallery']) && !empty($_FILES['imageGallery'])) {
                $nouvelleImage = $_FILES['imageGallery'];
                $nouvelleImageNom = basename($_FILES['imageGallery']['name']);
                var_dump($nouvelleImageNom);
                uploadImageGalerie($nouvelleImage,$_GET['pid']);
                sendImageGalerie($theProject['id'] , $nouvelleImageNom);
            }

            // Même chose pour les images articles
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

        }

        if (isset($_POST) && !empty($_POST)) {

        $editData = [
            'title' => $_POST['title'],
            'galleryText' => $_POST['galleryText'],
            'subtitle' => $_POST['subtitle'],
            'mainText' => $_POST['text'],
        ];

        editProject($_GET['pid'] , $editData);

    }

    if (isset($_GET['pid']) && $_GET['pid'] != "") {

    $theProject = getProjectById($_GET['pid']);
    $theProjectImageTitle = $theProject['imageTitre'];
    $theProjectImages = explode("," , $theProject['imagesArticle']);

    var_dump($theProject);
    var_dump($_POST);
    
    }

    include 'view/projectEditView.phtml';
    include 'view/projectImageTitleEditView.phtml';
    include 'view/projectImagesEditView.phtml';

}