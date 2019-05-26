<?php 


function getAdmin($login) {

	$db = openDatabase(); 

	$sql = "SELECT * FROM `admin` WHERE login LIKE '$login'";

	$statement = $db->query($sql, \PDO::FETCH_ASSOC);

	$user = [];

	foreach ($statement as $row) {
			$user = $row;
		}

	return $user;
}

function changePassword($login,$password) {
	
	$db = openDatabase();

	$sql = "UPDATE `admin` SET `password`= '$password' WHERE `login` = '$login'";

	$statement = $db->exec($sql);

}