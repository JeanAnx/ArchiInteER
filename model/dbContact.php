<?php

function getImageContact() {
	$db = openDatabase(); 
	$sql = "SELECT * FROM `imagecontact` ORDER BY `id` DESC LIMIT 1";
	$statement = $db->query($sql, \PDO::FETCH_ASSOC);
	$image_contact = [];
	foreach ($statement as $row) {
		$image_contact = $row;
	}
	return $image_contact;
}

function uploadImageContact($file) {
	$dossier = "img/imageContact/";
    if (isset($file['error']) && $file['error'] == "4" ) {
			$_SESSION['messages'][] = '<h2 class="">Oups. Une erreur s\'est produite</h2>';
			header("Location: missionEdit.php");
		} else {
		$fichier = reset($file['name']);
		if (file_exists(reset($file['tmp_name']))) {
			$resultUpload = move_uploaded_file(reset($file['tmp_name']), $dossier.$fichier);
			if ($resultUpload) {
				$_SESSION['messages'][] = '<h2 class="successMessage">Image "contact" modifiée</h2>';
				header("Location: contactEdit");			
			}
		}
    }
}

function sendImageContact($fileName) {
	$db = openDatabase(); 
	$data = [
		'filename' => $fileName
	];
	$sql = 'INSERT INTO `imagecontact`(`name`) VALUES (:filename)';
	$statement = $db->prepare($sql);
	return $statement->execute($data);
}

function setContactText($string) {
	$string = $string;
	$db = openDatabase(); 
	$sql = "INSERT INTO `textecontact`(`text`) VALUES ('$string')";
	$statement = $db->prepare($sql);
	$statement = $db->exec($sql);
}

function getContactText() {
	$db = openDatabase(); 
	$sql = "SELECT * FROM `textecontact` ORDER BY `id` DESC LIMIT 1 ";
	$statement = $db->query($sql , \PDO::FETCH_ASSOC);
	$text_contact = [];
	foreach ($statement as $row) {
		$text_contact = $row;
	}
	return $text_contact;
}
