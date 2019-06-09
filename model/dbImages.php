<?php 

/* Enregistrement en BDD de l'image Titre */

function sendImageGalerie($pid , $fileName) {

	$db = openDatabase(); 

	$data = [
		'name' => $fileName,
		'id' => $pid,
	];

	$sql = 'UPDATE `projets` SET `imageTitre`=:name WHERE `id` = :id';

	$statement = $db->prepare($sql);

	return $statement->execute($data);

}

/* Enregistrement de l'image dans le dossier */

function uploadImageGalerie($file , $edit) {

	if (is_dir("../img/imagesArticles/")) {
		$dossier = "../img/imagesArticles/";
		} else {
			$dossier = "img/imagesArticles/";
	}
	
    if ( isset($file['error']) && $file['error'] == "4" ) {

		header("Location: images.php?images=error");
		
        } else {

		$fichier = $file['name'];
		
		if (file_exists($file['tmp_name'])) {
		
			$resultUpload = move_uploaded_file($file['tmp_name'], $dossier.$fichier);

			if ($resultUpload) {

				if ($edit == FALSE) {
					header("Location: images.php?upload=ok&name=".$file['name']);
				} else if ($edit) {
					header("Location: projectEdit.php?pid=" . $edit . "&upload=ok&name=".$file['name']);
				}
			
			}

		}
        
    }

}

/* Enregistrement des images de l'article dans le dossier */

function uploadImages(array $images , $edit) {

	if (is_dir("../img/imagesArticles/")) {
		$dossier = "../img/imagesArticles/";
		} else {
			$dossier = "img/imagesArticles/";
	}

	foreach ($images as $theImage) {
	
		if ($theImage['error'] == "4" ) {
	
			header("Location: images.php?images=error");
			
			} else {
	
			$fichier = basename($theImage['name']);
			
				if (file_exists($theImage['tmp_name'])) {
	
					$resultUpload = move_uploaded_file($theImage['tmp_name'] , $dossier.$fichier);
					
					if ($resultUpload == false) {
	
						header("Location: images.php?upload=oups");
					
					}
				}
		}
	}

	if ($edit != FALSE){
	header('Location: projectEdit.php?pid='.$edit);
	}

}

/* Envoi des images de l'article en BDD */

// On récupére les images déjà existantes pour leur ajouter celles qu'on envoie, 
// si pas d'images on crée un tableau de zéro

function sendImages($pid , $imagesNames) {

	$thisProject = getProjectById($pid);

	if ($thisProject['imagesArticle'] != "") {
		$imagesToSend = explode("," , $thisProject['imagesArticle']);
	} else {
		$imagesToSend = [];
	}
	array_push($imagesToSend,$imagesNames);
	$db = openDatabase();
	$imagesToSend = implode("," , $imagesToSend);
	var_dump($imagesToSend);

	$data = [
		'id' => $pid,
		'names' => $imagesToSend,
	];

	$sql = 'UPDATE `projets` SET `imagesArticle`=:names WHERE `id` = :id';
	$statement = $db->prepare($sql);
	return $statement->execute($data);
}

//TODO Changer l'ordre des images

function deleteImage($pid , $imageName) {

	$db = openDatabase();

	$thisProject = getProjectById($pid);

	$imagesList = explode("," , $thisProject['imagesArticle']);

	$i = 0;
	foreach ($imagesList as $image) {
		
		if ($image == $imageName) {
			unset($imagesList[$i]);
		}

		$i++;

	}
		$imagesToSend = implode("," , $imagesList);

		$data = [
			'id' => $pid,
			'names' => $imagesToSend,
		];

		$sql = 'UPDATE `projets` SET `imagesArticle`=:names WHERE `id` = :id';

		$statement = $db->prepare($sql);

		return $statement->execute($data);

}


/****
 * GESTION DES IMAGES DU SLIDER EN BDD
 */

 function getImagesSlider() {

	$db = openDatabase(); 

	$sql = "SELECT * FROM `imagesslider` ORDER BY `id` DESC LIMIT 1";

	$statement = $db->query($sql, \PDO::FETCH_ASSOC);

	$imagesSlider = [];

	foreach ($statement as $row) {
		$imagesSlider = $row;
	}

	return $imagesSlider;
 }


function uploadImagesSlider(array $images) {

	foreach ($images as $theImage) {

		$dossier = "../img/flexslider/";
	
		if ($theImage['error'] == "4" ) {
	
			header("Location: images.php?images=error");
			
			} else {
	
			$fichier = basename($theImage['name']);
			
				if (file_exists($theImage['tmp_name'])) {
	
					$resultUpload = move_uploaded_file($theImage['tmp_name'] , $dossier.$fichier);
					
					if ($resultUpload == false) {
	
						header("Location: images.php?upload=oups");
					
					}
				}
		}
	}
}

function sendImagesSlider($imagesNames) {

	if (isset(getImagesSlider()['list'])) {
	$currentImages = getImagesSlider()['list'];
		} else {
			$currentImages = "";
		}

	if ($currentImages != " ") {
	$imagesToSend = explode(',' , trim(getImagesSlider()['list']));
		} else {
			$imagesToSend = [];
	}
	array_push($imagesToSend,$imagesNames);

	$db = openDatabase();
	$imagesToSend = implode("," , $imagesToSend);

	$data = [
		'names' => $imagesToSend,
	];

	$sql = 'INSERT INTO `imagesslider`(`list`) VALUES (:names)';

	$statement = $db->prepare($sql);

	return $statement->execute($data);
}

function deleteImageSlider($imageName) {

	$db = openDatabase();

	$imagesSlider = getImagesSlider()['list'];

	$imagesList = explode("," , $imagesSlider);

	$i = 0;
	foreach ($imagesList as $image) {
		
		if ($image == $imageName) {
			unset($imagesList[$i]);
		}
		$i++;
	}
		$imagesToSend = implode("," , $imagesList);

		$data = [
			'names' => $imagesToSend,
		];
	
		$sql = 'INSERT INTO `imagesslider`(`list`) VALUES (:names)';
	
		$statement = $db->prepare($sql);
	
		return $statement->execute($data);

}
