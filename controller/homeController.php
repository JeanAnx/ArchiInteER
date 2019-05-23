<?php 

require_once 'model/db.php';

$intro = getIntro();

$imagesSlider = getImagesSlider()['list'];
var_dump($imagesSlider);

require_once 'view/homeView.phtml';

