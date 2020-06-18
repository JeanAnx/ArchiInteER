<?php 

function getMentions(){
	$db = openDatabase(); 
	$sql = "SELECT * FROM `mentions` ORDER BY `id` DESC LIMIT 1 ";
	$statement = $db->query($sql , \PDO::FETCH_ASSOC);
	$mentions = [];
	foreach ($statement as $row) {
		$mentions = $row;
	}
	return $mentions;
};

function setMentions($string){
	$string = $string;
	$db = openDatabase(); 
	$sql = "INSERT INTO `mentions`(`texte`) VALUES ('$string')";
	$statement = $db->prepare($sql);
	$statement = $db->exec($sql);
};
