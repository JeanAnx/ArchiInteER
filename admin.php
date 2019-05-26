<?php
session_start();
require_once 'model/db.php';

$intro = getIntro();
$projets = getAllProjects();
$imagesSliderData = getImagesSlider();
if (isset($imagesSliderData['list']) && !empty($imagesSliderData['list'])) {
$imagesSlider = explode("," , getImagesSlider()['list']);
$imagesSlider = cleanArray($imagesSlider);
var_dump($imagesSlider);
} else {
    $imagesSlider = [];
}

if ($_SESSION['admin'] != "yes") {
    header('Location: login');
} else {
    $_SESSION['name'] = 'Admin';
    include_once 'view/adminView.phtml';
}
