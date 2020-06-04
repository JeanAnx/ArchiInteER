<?php 

require_once 'model/db.php';

$image_mission_header = 'img/imageMission/' . getImageIntroMission()['name'];
$text_image_mission_header = getTextImageMission()['text'];
$text_mission_intro = getMissionIntroText()['text'];

require_once 'view/headerView.phtml';
require_once 'view/missionsView.phtml';

