<?php


function openDatabase() {

	$user = 'root';
	$pass = 'm12gi8gefxJWJRGs';
	$db = new PDO('mysql:host=localhost;dbname=siteemilie' , $user , $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	$db->exec('SET NAMES UTF8');

	return $db;

}

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

function getPlayers() {

	$db = openDatabase(); 

	$sql = "SELECT * FROM players";

	$statement = $db->query($sql,\PDO::FETCH_ASSOC);

	$players = [];

	foreach ($statement as $row) {
		$players[] = $row;
	}

	return $players;

}

function getPlayerById($playerId) {

	$db = openDatabase(); 

	$sql = "SELECT * FROM players WHERE `id` = '$playerId'";

	$statement = $db->query($sql, \PDO::FETCH_ASSOC);

	foreach ($statement as $row) {
		$thePlayer = $row;
	}

	return $thePlayer;

}

function getArticles() {

	$db = openDatabase(); 

	$sql = "SELECT * FROM articles ORDER BY `created_at` DESC";

	$statement = $db->query($sql, \PDO::FETCH_ASSOC);

	$articles = [];

	foreach ($statement as $row) {
		$articles[] = $row;
	}

	return $articles;

}

function getLatestArticle() {

	$db = openDatabase(); 

	$sql = "SELECT * FROM articles ORDER BY `created_at` DESC limit 1";

	$statement = $db->query($sql, \PDO::FETCH_ASSOC);

	$article = '';

	foreach ($statement as $row) {
		$article = $row;
	}

	return $article;

}

function createUser(array $newUser) {

	$db = openDatabase(); 

	$newUserData = [

		'firstname' => $newUser['firstname'],
		'lastname' => $newUser['lastname'],
		'birthdate' => $newUser['birthdate'],
		'address' => $newUser['address'],
		'zipcode' => $newUser['zipCode'],
		'city' => $newUser['city'],
		'phone' => $newUser['phone'],
		'email' => $newUser['email'],
		'pseudo' => $newUser['pseudo'],
		'password' => password_hash($newUser['password'],PASSWORD_BCRYPT),
	];


	$sql = "INSERT INTO `fans` (firstname,lastname,birthdate,address,zipcode,city,phone,email,pseudo,password,created_at)
	VALUES (:firstname,:lastname,:birthdate,:address,:zipcode,:city,:phone,:email,:pseudo,:password,NOW())";

	$statement = $db->prepare($sql);
	$statement->execute($newUserData);

}

