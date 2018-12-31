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

function changePassword($login,$password) {
	
	$db = openDatabase();

	$sql = "UPDATE `admin` SET `password`= '$password' WHERE `login` = '$login'";

	$statement = $db->exec($sql);

}

function getProjects() {

	$db = openDatabase(); 

	$sql = "SELECT * FROM projets ORDER BY `created_at` DESC";

	$statement = $db->query($sql, \PDO::FETCH_ASSOC);

	$projets = [];

	foreach ($statement as $row) {
		$projects[] = $row;
	}

	return $projects;

}


function getProjectById($projectId) {

	$db = openDatabase(); 

	$sql = "SELECT * FROM projets WHERE `id` = '$projectId'";

	$statement = $db->query($sql, \PDO::FETCH_ASSOC);

	foreach ($statement as $row) {
		$theProject = $row;
	}

	return $theProject;

}


function getLatestProject() {

	$db = openDatabase(); 

	$sql = "SELECT * FROM projets ORDER BY `created_at` DESC limit 1";

	$statement = $db->query($sql, \PDO::FETCH_ASSOC);

	$latestProjet = '';

	foreach ($statement as $row) {
		$latestProjet = $row;
	}

	return $latestProjet;

}

function createProject(array $newProject) {

	$db = openDatabase(); 

	$newProjectData = [

		'title' => $newProject['title'],
		'subtitle' => $newProject['subtitle'],
		'content' => $newProject['content']
	];


	$sql = "INSERT INTO `projets` (title,subtitle,content,created_at)
	VALUES (:title,:subtitle,:content,NOW())";

	$statement = $db->prepare($sql);
	$statement->execute($newProjectData);

}

