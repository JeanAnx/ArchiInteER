<?php 

/**
 * IMAGES DE LA PAGE INSPIRATIONS.
 */

function getImagesInspirations() {
	$db = openDatabase(); 
	$sql = "SELECT * FROM `imagesinspirations` ORDER BY `id` DESC LIMIT 1";
	$statement = $db->query($sql, \PDO::FETCH_ASSOC);
	$imagesInspirations = [];
	foreach ($statement as $row) {
		$imagesInspirations = $row;
	}
	return $imagesInspirations;
}

function uploadImagesInspirations(array $images) {

	if (is_dir("../img/imagesInspirations/")) {
		$dossier = "../img/imagesInspirations/";
		} else {
			$dossier = "img/imagesInspirations/";
	}
	foreach ($images as $theImage) {	
		if ($theImage['error'] == "4" ) {	
			header("Location: inspirationsEdit.phtml?images=error");
			} else {	
			$fichier = basename($theImage['name']);
				if (file_exists($theImage['tmp_name'])) {
					$resultUpload = move_uploaded_file($theImage['tmp_name'] , $dossier.$fichier);					
					if ($resultUpload == false) {	
						header("Location: inspirationsEdit.phtml?upload=oups");					
					}
				}
		}
	}
	header('Location: inspirationsEdit.php');
}

function sendImagesInspirations($imagesNames) {
	if (isset(getImagesInspirations()['list'])) {
	$currentImages = getImagesInspirations()['list'];
		} else {
			$currentImages = "";
		}
	if ($currentImages != " ") {
	$imagesToSend = explode(',' , trim(getImagesInspirations()['list']));
		} else {
			$imagesToSend = [];
	}
	array_push($imagesToSend,$imagesNames);
	$db = openDatabase();
	$imagesToSend = implode("," , $imagesToSend);
	$data = [
		'names' => trim($imagesToSend,','),
	];
	$sql = 'INSERT INTO `imagesinspirations`(`list`) VALUES (:names)';
	$statement = $db->prepare($sql);
	return $statement->execute($data);
}

function getTitleInspirations() {
	$db = openDatabase(); 
	$sql = "SELECT * FROM `titresinspirations` ORDER BY `id` DESC LIMIT 1 ";
	$statement = $db->query($sql , \PDO::FETCH_ASSOC);
	$intro = [];
	foreach ($statement as $row) {
		$text = $row;
	}
	return $text;
}

function setTitleInspirations($string) {
    $db = openDatabase();   
    $sql = "INSERT INTO `titresinspirations` (`titre`) VALUES (:titre)"; 
    $statement = $db->prepare($sql);
    $statement->bindParam(":titre", $string);
	$statement->execute();
}

function getTextInspirations() {
	$db = openDatabase(); 
	$sql = "SELECT * FROM `texteinspirations` ORDER BY `id` DESC LIMIT 1 ";
	$statement = $db->query($sql , \PDO::FETCH_ASSOC);
	$text = [];
	foreach ($statement as $row) {
		$text = $row;
	}
	return $text;
}

function setTextInspirations($string) {
	$db = openDatabase();     
    $sql = "INSERT INTO `texteinspirations` (`text`) VALUES (:texte)"; 
    $statement = $db->prepare($sql);
    $statement->bindParam(":texte", $string);
	$statement->execute();
}

function deleteImageInspirations($imageName) {
	$db = openDatabase();
	$imagesList = explode(',',getImagesInspirations()['list']);
	$i = 0;
	foreach ($imagesList as $image) {
		if ($image == $imageName) {
			unset($imagesList[$i]);
		}
		$i++;
	}
	$imagesToSend = implode("," , $imagesList);
	$sql = "INSERT INTO `imagesinspirations` (`list`) VALUES (:images)"; 
	$statement = $db->prepare($sql);
	$statement->bindParam(":images", $imagesToSend);
	return $statement->execute();
}
