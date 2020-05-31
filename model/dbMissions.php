<?php

function getMissions() {

	$db = openDatabase(); 

	$sql = "SELECT * FROM missions ORDER BY `order` DESC";

	$statement = $db->query($sql, \PDO::FETCH_ASSOC);

	$missions = [];

	foreach ($statement as $row) {
		$missions[] = $row;
	}

	return $missions;

}