<?php 


function getIntro() {

	$db = openDatabase(); 

	$sql = "SELECT * FROM `intro` ORDER BY `id` DESC LIMIT 1 ";

	$statement = $db->query($sql , \PDO::FETCH_ASSOC);
	
	$intro = [];

	foreach ($statement as $row) {
		$intro = $row;
	}

	return $intro;
}

function setIntro($string) {

	$string = htmlentities($string);

	$db = openDatabase(); 

	$sql = "INSERT INTO `intro`(`texte`) VALUES ('$string')";

	$statement = $db->prepare($sql);
	$statement = $db->exec($sql);
	
}