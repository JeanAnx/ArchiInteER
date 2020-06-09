<?php 

require_once 'model/db.php';

$image_mission_header = 'img/imageMission/' . getImageIntroMission()['name'];
$text_image_mission_header = getTextImageMission()['text'];
$text_mission_intro = getMissionIntroText()['text'];
dump($text_mission_intro);
die;
$missions = [];
for ($i=1; $i < 4; $i++) { 
  $missions[$i] = getMission($i);	
}

require_once 'view/headerView.phtml';
require_once 'view/missionsView.phtml';

