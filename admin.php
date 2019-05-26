<?php
session_start();
require_once 'model/db.php';

    $_SESSION['messages'] = [];

    // Message de confirmation de modif du texte d'intro
    if (isset($_SESSION['intro']) && $_SESSION['intro'] == 'ok') { 
        $_SESSION['intro'] = '';
        $_SESSION['messages'][] = '<h2 class="successMessage"> <i class="fas fa-check"></i> L\'introduction a bien été modifiée</h2>';
    }
    // Message d'erreur pour une erreur projet
    if (isset($_SESSION['error']) && $_SESSION['error'] == 'projet') { 
        $_SESSION['error'] = '';
        $_SESSION['messages'][] = '<h2 class="errorMessage"><i class="fas fa-times"></i> Une erreur s\'est produite </h2>';
        }
    // Message de confirmation pour modif des images du slider
    if (isset($_SESSION['slider']) && $_SESSION['slider'] == 'ok') { 
        $_SESSION['intro'] = '';
        $_SESSION['messages'][] = '<h2 class="successMessage"> <i class="fas fa-check"></i> Le slider a bien été modifié </h2>'; 
    }
    // Message de confirmation pour suppression d'un projet
    if (isset($_SESSION['projet']) && $_SESSION['projet'] == 'deleted') { 
        $_SESSION['projet'] = '';
        $_SESSION['messages'][] = '<h2 class="successMessage"> <i class="fas fa-check"></i> Le projet a bien été supprimé </h2>'; 
    }

$intro = getIntro();
$projets = getAllProjects();
$imagesSliderData = getImagesSlider();
if (isset($imagesSliderData['list']) && !empty($imagesSliderData['list'])) {
$imagesSlider = explode("," , getImagesSlider()['list']);
$imagesSlider = cleanArray($imagesSlider);
} else {
    $imagesSlider = [];
}

if ($_SESSION['admin'] != "yes") {
    header('Location: login');
} else {
    $_SESSION['name'] = 'Admin';
    include_once 'view/adminView.phtml';
}
