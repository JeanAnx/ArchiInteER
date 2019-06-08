<?php 

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



function deleteProject($id) {

    $db = openDatabase();
    
    $sql = "DELETE FROM `projets` WHERE `projets`.`id` = '$id'";

    $statement = $db->prepare($sql);

	return $statement->execute();

}


function getProjectById($projectId) {

	$db = openDatabase(); 

	$sql = "SELECT * FROM projets WHERE `id` = '$projectId'";

	$statement = $db->query($sql, \PDO::FETCH_ASSOC);

    $theProject = false;

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

function editProject(array $editProject) {

	$db = openDatabase(); 

	$pid = $editProject['pid'];

	$editProjectData = [

		'title' => $editProject['title'],
		'galleryText' => $editProject['galleryText'],
		'subtitle' => $editProject['subtitle'],
		'mainText' => $editProject['mainText'],
	];
// TODO Modifier syntaxe
	$sql = "UPDATE `projets` (titre,sousTitre,texteGalerie,texte,dateCreation)
	SET (:title,:subtitle,:galleryText,:mainText,NOW())
	WHERE `id` = {pid}";

	$statement = $db->prepare($sql);
	return $statement->execute($editProjectData);

}

function togglePublishProject($pid) {

	$thisProject = getProjectById($pid);

	if ($thisProject['published'] == 1) {

		$newStatus = 0;

	} else if ($thisProject['published'] == 0) {

		$newStatus = 1;

	}

	$db = openDatabase();

	$editProjectData = [
		'newStatus' => $newStatus,
	];

	$sql = "UPDATE `projets`
	SET `published` = (:newStatus)
	WHERE `id` = '$pid'";

	$statement = $db->prepare($sql);
	return $statement->execute($editProjectData);


}