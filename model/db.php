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

function uploadImages($pid , $file) {

	$dossier = "img/imagesArticles/";
	
    if ($file['file']['error'] == "4" ) {

		header("Location: images.php?images=error");
		
        } else {

        $fichier = basename($file['file']['name']);
		
            if (file_exists($file['file']['tmp_name'])) {

                $resultUpload = move_uploaded_file($file['file']['tmp_name'] , $dossier.$fichier);
                
                if ($resultUpload) {

                    header("Location: images.php?upload=ok&name=".$file['file']['name']);
				
				}
            }
        
    }
        
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


