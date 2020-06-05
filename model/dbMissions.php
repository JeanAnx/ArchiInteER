<?php

function createMission(array $newMission) {

	$db = openDatabase(); 

	$newMissionData = [
		'titre' => $newMission['title'],
		'corps' => $newMission['galleryText'],
		'image' => $newMission['subtitle'],
		'ordre' => $newMission['mainText'],
	];

	$sql = "INSERT INTO `missions` (titre,corps,image,ordre)
	VALUES (:titre,:corps,:image,:ordre)";

	$statement = $db->prepare($sql);
	return $statement->execute($newMissionData);

}

function deleteMission($id) {
  $db = openDatabase();
  $sql = "DELETE FROM `missions` WHERE `missions`.`id` = '$id'";
  $statement = $db->prepare($sql);
return $statement->execute();
}

function editMission($mid , array $editMission) {

	$db = openDatabase(); 
	$editMissionData = [
		'titre' => $edit_mission['titre'],
		'galleryText' => $edit_mission['corps'],
		'subtitle' => $edit_mission['image'],
		'mainText' => $edit_mission['ordre'],
	];

	$sql = "UPDATE `missions` 
	SET `titre` = (:titre),
	`corps` = (:corps),
	`image` = (:image),
	`ordre` = (:ordre)
	WHERE `id` = $mid";

	$statement = $db->prepare($sql);
	return $statement->execute($editMissionData);

}

/**
 * Images.
 */

// Image intro page "Missions"

function getImageIntroMission() {
	$db = openDatabase(); 
	$sql = "SELECT * FROM `imagemission` ORDER BY `id` DESC LIMIT 1";
	$statement = $db->query($sql, \PDO::FETCH_ASSOC);
	$image_mission = [];
	foreach ($statement as $row) {
		$image_mission = $row;
	}
	return $image_mission;
}

function uploadImageIntroMission($file) {
	$dossier = "img/imageMission/";
    if (isset($file['error']) && $file['error'] == "4" ) {
			$_SESSION['messages'][] = '<h2 class="">Oups. Une erreur s\'est produite</h2>';
			header("Location: missionEdit.php");
		} else {
		$fichier = reset($file['name']);
		if (file_exists(reset($file['tmp_name']))) {
			$resultUpload = move_uploaded_file(reset($file['tmp_name']), $dossier.$fichier);
			if ($resultUpload) {
				$_SESSION['messages'][] = '<h2 class="successMessage">Image d\'intro "Missions" modifiée</h2>';
				header("Location: missionsEdit");			
			}
		}
    }
}

function sendImageIntroMission($fileName) {
	$db = openDatabase(); 
	$data = [
		'filename' => $fileName
	];
	$sql = 'INSERT INTO `imagemission`(`name`) VALUES (:filename)';
	$statement = $db->prepare($sql);
	return $statement->execute($data);
}

// Image Bloc "Missions"

function getBlocsImagesMissions() {
	$db = openDatabase(); 
	$sql = "SELECT * FROM `imagesblocsmissions` ORDER BY `id` DESC LIMIT 1";
	$statement = $db->query($sql, \PDO::FETCH_ASSOC);
	$images_blocs_mission = [];
	foreach ($statement as $row) {
		$images_blocs_mission[] = $row;
	}
	return $images_blocs_mission;
}

function uploadBlocImageMission($file) {
	$dossier = "../img/imagesBlocsMissions/";
    if ( isset($file['error']) && $file['error'] == "4" ) {
		header("Location: admin.php?images=error");
		} else {
		$fichier = $file['name'];
		if (file_exists($file['tmp_name'])) {
			$resultUpload = move_uploaded_file($file['tmp_name'], $dossier.$fichier);
			if ($resultUpload) {
				return true;
			}
		}
    }
}

function sendBlocImageMission($fileName) {
	$db = openDatabase(); 
	$data = [
		'filename' => $fileName
	];
	$sql = 'INSERT INTO `imagemission`(`name`) VALUES (:filename)';
	$statement = $db->prepare($sql);
	return $statement->execute($data);
}

// Texte dans l'image du header.

function setTextImageMission($string) {
	$string = $string;
	$db = openDatabase(); 
	$sql = "INSERT INTO `texteimagemission`(`text`) VALUES ('$string')";
	$statement = $db->prepare($sql);
	$statement = $db->exec($sql);
}

function getTextImageMission() {
	$db = openDatabase(); 
	$sql = "SELECT * FROM `texteimagemission` ORDER BY `id` DESC LIMIT 1 ";
	$statement = $db->query($sql , \PDO::FETCH_ASSOC);
	$text_image = [];
	foreach ($statement as $row) {
		$text_image = $row;
	}
	return $text_image;
}

// Texte de l'introduction. 

function setMissionIntroText($string) {
	$string = $string;
	$db = openDatabase(); 
	$sql = "INSERT INTO `texteintromission`(`text`) VALUES ('$string')";
	$statement = $db->prepare($sql);
	$statement = $db->exec($sql);
}

function getMissionIntroText() {
	$db = openDatabase(); 
	$sql = "SELECT * FROM `texteintromission` ORDER BY `id` DESC LIMIT 1 ";
	$statement = $db->query($sql , \PDO::FETCH_ASSOC);
	$text_intro = [];
	foreach ($statement as $row) {
		$text_intro = $row;
	}
	return $text_intro;
}

// Missions.

function getMissions() {
	$db = openDatabase(); 
	$sql = "SELECT * FROM missions";
	$statement = $db->query($sql, \PDO::FETCH_ASSOC);
	$projets = [];
	foreach ($statement as $row) {
		$projets[] = $row;
	}
	return $projets;
}

function setMissions(array $mission, $index) {
	$db = openDatabase(); 
	$current_missions = json_decode(getMissions());
	$missions_json = json_encode($missions);
	$sql = "INSERT INTO `missions` (data_json)
	VALUES (missions_json)";
	$statement = $db->prepare($sql);
	return $statement->execute($missions_json);
}

function uploadSingleImageBloc($file) {
	$dossier = "img/imagesBlocsMissions/";
	if (isset($file['error']) && $file['error'] == "4" ) {
		$_SESSION['messages'][] = '<h2 class="">Oups. Une erreur s\'est produite</h2>';
		header("Location: missionEdit.php");
	} else {
	$fichier = $file['name'];
	if (file_exists($file['tmp_name'])) {
		$resultUpload = move_uploaded_file($file['tmp_name'], $dossier.$fichier);
		if ($resultUpload) {
			$_SESSION['messages'][] = '<h2 class="successMessage">Image modifiée</h2>';
			header("Location: missionsEdit");			
		}
	}
	}
}
