<?php 

require_once 'model/db.php';

$images_inspirations = getImagesInspirations();
$texte_inspirations = getTextInspirations()['text'];
$titre_inspirations = getTitleInspirations()['titre'];

require_once 'view/inspirationsView.phtml';

