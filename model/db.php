<?php


function openDatabase() {

	$user = 'root';
	$pass = 'm12gi8gefxJWJRGs';
	$db = new PDO('mysql:host=localhost;dbname=siteemilie' , $user , $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	$db->exec('SET NAMES UTF8');

	return $db;
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

function uploadImageGalerie($file) {

	$dossier = "../img/imagesArticles/";
	
    if ( isset($file['error']) && $file['error'] == "4" ) {

		header("Location: images.php?images=error");
		
        } else {

		$fichier = $file['name'];
		
		if (file_exists($file['tmp_name'])) {
		
			$resultUpload = move_uploaded_file($file['tmp_name'], $dossier.$fichier);

			if ($resultUpload) {

				header("Location: images.php?upload=ok&name=".$file['name']);
			
			}

		}
        
    }

}

/* Enregistrement des images de l'article dans le dossier */

function uploadImages(array $images) {

	foreach ($images as $theImage) {

		$dossier = "../img/imagesArticles/";
	
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

// TO DO Suppression d'une image
// Changer l'ordre des images

function deleteImage($pid , $imageName) {

	$db = openDatabase();

	$thisProject = getProjectById($pid);

	$imagesList = explode("," , $thisProject['imagesArticle']);

	$i = 0;
	foreach ($imagesList as $image) {
		
		if ($image == $imageName) {
			unset($imagesList[$i]);
		}

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

// WIP WIP WIP WIP WIP WIP

function sendImagesSlider($imagesNames) {

	$imagesToSend = [];

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

	$imagesSlider = 

	$imagesList = explode("," , $thisProject['imagesArticle']);

	$i = 0;
	foreach ($imagesList as $image) {
		
		if ($image == $imageName) {
			unset($imagesList[$i]);
		}

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



function getIntro() {

	$db = openDatabase(); 

	$sql = "SELECT * FROM `intro` ORDER BY `id` DESC LIMIT 1 ";

	$statement = $db->query($sql , \PDO::FETCH_ASSOC);
	
	$intro = [];

	foreach ($statement as $row) {
		$intro = $row;
	}

	return $intro;
}

function setIntro($string) {

	$string = htmlentities($string);

	$db = openDatabase(); 

	$sql = "INSERT INTO `intro`(`texte`) VALUES ('$string')";

	$statement = $db->prepare($sql);
	$statement = $db->exec($sql);
	
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


