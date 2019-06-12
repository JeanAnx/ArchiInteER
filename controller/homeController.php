<?php 

require_once 'model/db.php';

$intro = getIntro();
$imageIntro = getImageIntro()['name'];
$imagesSlider = explode(',',getImagesSlider()['list']);
$imagesSlider = cleanArray($imagesSlider);

require_once 'view/homeView.phtml';

