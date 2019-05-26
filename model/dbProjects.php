<?php 


function createProject(array $newProject) {

	$db = openDatabase(); 

	$newProjectData = [

		'title' => $newProject['title'],
		'galleryText' => $newProject['galleryText'],
		'subtitle' => $newProject['subtitle'],
		'mainText' => $newProject['mainText'],
		'published' => $newProject['published']
	];

	$sql = "INSERT INTO `projets` (titre,sousTitre,texteGalerie,texte,dateCreation,published)
	VALUES (:title,:subtitle,:galleryText,:mainText,NOW(),:published)";

	$statement = $db->prepare($sql);
	return $statement->execute($newProjectData);

}

/**
 * WIP WIP WIP WIP WIP WIP WIP SUPPRESSION/MODIFICATION/ET PUBLICATION 
 * D'UN PROJET
 */

function togglePublishProject($id) {

	$db = openDatabase(); 


}

function deleteProject($id) {

	$db = openDatabase(); 


}


function getAllProjects() {

	$db = openDatabase(); 

	$sql = "SELECT * FROM projets ORDER BY `dateCreation` DESC";

	$statement = $db->query($sql, \PDO::FETCH_ASSOC);

	$projets = [];

	foreach ($statement as $row) {
		$projects[] = $row;
	}

	return $projects;

}

function getPublishedProjects() {

	$db = openDatabase(); 

	$sql = "SELECT * FROM projets WHERE `published` = 1 ORDER BY `dateCreation` DESC";

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

	$sql = "SELECT * FROM projets ORDER BY `dateCreation` DESC limit 1";

	$statement = $db->query($sql, \PDO::FETCH_ASSOC);

	$latestProjet = '';

	foreach ($statement as $row) {
		$latestProjet = $row;
	}

	return $latestProjet;

}

