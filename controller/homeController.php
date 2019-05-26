<?php 

require_once 'model/db.php';

$intro = getIntro();

$imagesSlider = explode(',',getImagesSlider()['list']);
$imagesSlider = cleanArray($imagesSlider);

require_once 'view/homeView.phtml';

