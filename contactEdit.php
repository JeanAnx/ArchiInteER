<?php

/**
 * Regroupe la page et les traitements.
 */
session_start();

 if (isset($_SESSION['admin']) && $_SESSION['admin'] == 'yes') {
	
  require "model/db.php";

	// If image data sent, trigger functions.
	if (isset($_FILES['image_header_contact']) && !empty($_FILES['image_header_contact'])) {
		// Send in db name of the file.
		$send_image_intro_mission = sendImageContact(reset($_FILES['image_header_contact']['name']));
		$save_file = uploadImageContact($_FILES['image_header_contact']);
	}
	// Text on image process.
	if (isset($_POST['image-text-header'])) {
		setContactText($_POST['image-text-header']);
	}


	// TODO : traitement des données POST et FILES
	// Extraire l'index du nom du champ
	// Récupérer json des missions et modifier l'index concerné
	// Resérialiser et renvoyer.
	// Si Files, et si pas l'image du header, envoi simple de l'image dans le dossier.

	if (isset($_FILES) && !empty($_FILES) && !isset($_FILES['image_header_contact'])) {
		$bloc_mission_image = [];
		foreach ($_FILES as $key => $file) {
			// Enregistrement du fichier.
			uploadSingleImageBloc($file);
			// Extraction de l'index cible.
			$index = intval(explode('-',$key)[2]);
			// Envoi mission (index de la mission, contenu texte et image).
			setMission($index, null, $file['name']);
			}
		}

	// Get page data.
	$image_contact_header = 'img/imageContact/' . getImageContact()['name'];
	$text_image_contact_header = getContactText();
	?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<script
			  src="https://code.jquery.com/jquery-3.4.1.min.js"
			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			  crossorigin="anonymous"></script>
	<!-- include libraries(jQuery, bootstrap) -->
	<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 

	<!-- include summernote css/js -->
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/admin.css">
	<script type='text/javascript' src='js/admin.js'></script>
			  
	<title>Administration</title>
</head>
<body>

<main class="max-width-80 margin-auto">

	<h1 class="align-center">Administration</h1>
	<div class="articleTools">
	<a href="admin">Retour à l'accueil</a>
</div>

	<div id="backToTheTop">
		<a href="#blocAdmin"><i class="fas fa-caret-up"></i></a>
	</div>

	<?php if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])) { ?>

	<section class="messages">
		
		<?php foreach ($_SESSION['messages'] as $message) {
			echo $message;
			$_SESSION['messages'] = [];
		 } 
		 
		} ?>

		</section>

<div id="blocAdmin">

	<h2>- Page "Contact" -</h2>

	<h3>Image du header</h3>

	<form class="padding-2 mission-header-form" action="" method="POST" enctype="multipart/form-data">
		<label for="image_header_contact">Modifier l'image de la page "Contact" :</label>
		<input type="file" name="image_header_contact[]" multiple>
		<input class="width-max-content" id="image-header-missions" type="submit" value="Ajouter">
		<div class="display-image-header-missions">

		<?php 

		if (isset($image_contact_header)) { ?>
			<img class="imgMiniature" src="<?=$image_contact_header?>">
			<?php } else { ?>
					<h3 class="noPicture">Pas d'image</h3>
			<?php } ?>
					
</div>

	</form>

		<h3>Image texte header</h3>
		<form class="padding-2" action="" method="POST">
			<label for="image-text-header">Texte de l'image :</label>
			<textarea name="image-text-header" id="image-text-header" cols="30" rows="5">
				<?= $text_image_contact_header['text'] ?>
			</textarea>
			<input class="width-max-content" type="submit" value="Enregistrer">
		</form>

          <?php		
          
        };

