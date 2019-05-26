<?php 

require_once 'model/db.php';

$intro = getIntro();

$imagesSlider = explode(',',getImagesSlider()['list']);
var_dump($imagesSlider);

require_once 'view/homeView.phtml';

