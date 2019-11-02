<?php 

require_once 'model/db.php';

$images_inspirations = explode("," , getImagesInspirations()['list']);
$texte_inspirations = getTextInspirations()['text'];
$titre_inspirations = getTitleInspirations()['titre'];

require_once 'view/inspirationsView.phtml';

