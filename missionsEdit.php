<?php

/**
 * Regroupe la page et les traitements.
 */
session_start();


if (isset($_SESSION['admin']) && $_SESSION['admin'] == 'yes') {  
	
	require "model/db.php";

	// If image data sent, trigger functions.
	if (isset($_FILES['image_header_mission']) && !empty($_FILES['image_header_mission'])) {
		// Send in db name of the file.
		$send_image_intro_mission = sendImageIntroMission(reset($_FILES['image_header_mission']['name']));
		$save_file = uploadImageIntroMission($_FILES['image_header_mission']);
	}
	// Text on image process.
	if (isset($_POST['image-text-header'])) {
		setTextImageMission($_POST['image-text-header']);
	}
	// Intro text.
	if (isset($_POST['intro-text-missions'])) {
		setMissionIntroText($_POST['intro-text-missions']);
	}
	// Get page data.
	$image_mission_header = 'img/imageMission/' . getImageIntroMission()['name'];
	$text_image_mission_header = getTextImageMission();
	$text_mission_intro = getMissionIntroText();
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

	<link rel="stylesheet" type="text/css" href="css/admin.css">
	<script type='text/javascript' src='js/admin.js'></script>
			  
	<title>Administration</title>
</head>
<body>

<main class="max-witdh-90">

	<h1 class="align-center">Administration</h1>
	<div class="articleTools">
	<a href="admin.php">Retour à l'accueil</a>
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

<div id="blocAdmin">

	<h2>- Page "Missions" -</h2>

	<h3>Image du header</h3>

	<form class="mission-header-form" action="" method="POST" enctype="multipart/form-data">
		<label for="image_header_mission">Modifier l'image de la page "Missions" :</label>
		<input type="file" name="image_header_mission[]" multiple>
		<input  id="image-header-missions" type="submit" value="Ajouter">
		<div class="display-image-header-missions">

		<?php 

		if (isset($image_mission_header)) { ?>
			<img class="imgMiniature" src="<?=$image_mission_header?>">
			<?php } else { ?>
					<h3 class="noPicture">Pas d'image</h3>
			<?php } ?>
					
</div>

	</form>

		<h3>Image texte header</h3>
		<form action="" method="POST">
			<label for="image-text-header">Texte de l'image :</label>
			<textarea name="image-text-header" id="image-text-header" cols="30" rows="5">
				<?= $text_image_mission_header['text'] ?>
			</textarea>
			<input type="submit" value="Enregistrer">
		</form>


		<h3>Texte de présentation</h3>
		<form action="" method="POST">
			<label for="intro-text-missions">Texte de l'intro :</label>
			<textarea name="intro-text-missions" id="intro-text-missions" cols="30" rows="5">
				<?= $text_mission_intro['text'] ?>
			</textarea>
			<input type="submit" value="Enregistrer">
		</form>

		<h3>Blocs</h3>

		<form action="" method="POST">

		<fieldset class="flex-column">
			<h3>1</h3>
			<label for="title-mission-1">Titre du bloc mission :</label>
			<input type="text" placeholder="" id="title-mission-1" name="title-mission-1">
			<label for="text-mission-1">Texte du bloc mission :</label>
			<textarea name="text-mission-1" id="text-mission-1" cols="30" rows="5"></textarea>
			<label for="order_mission_1">Ordre</label>
			<input type="number" min="1" max="100" id="order-mission-1" name="order-mission-1" placeholder="">
		</fieldset>

		<fieldset class="flex-column">
			<h3>2</h3>
			<label for="title-mission-2">Titre du bloc mission :</label>
			<input type="text" placeholder="" id="title-mission-2" name="title-mission-2">
			<label for="text-mission-2">Texte du bloc mission :</label>
			<textarea name="text-mission-2" id="text-mission-2" cols="30" rows="5"></textarea>
			<label for="order_mission_2">Ordre</label>
			<input type="number" min="1" max="100" id="order-mission-2" name="order-mission-2" placeholder="">
		</fieldset>

		<fieldset class="flex-column">
			<h3>3</h3>
			<label for="title-mission-3">Titre du bloc mission :</label>
			<input type="text" placeholder="" id="title-mission-3" name="title-mission-3">
			<label for="text-mission-3">Texte du bloc mission :</label>
			<textarea name="text-mission-3" id="text-mission-3" cols="30" rows="5"></textarea>
			<label for="order_mission_3">Ordre</label>
			<input type="number" min="1" max="100" id="order-mission-3" name="order-mission-3" placeholder="">
		</fieldset>

		<fieldset class="flex-column">
			<h3>4</h3>
			<label for="title-mission-4">Titre du bloc mission :</label>
			<input type="text" placeholder="" id="title-mission-4" name="title-mission-4">
			<label for="text-mission-4">Texte du bloc mission :</label>
			<textarea name="text-mission-4" id="text-mission-4" cols="30" rows="5"></textarea>
			<label for="order_mission_4">Ordre</label>
			<input type="number" min="1" max="100" id="order-mission-4" name="order-mission-4" placeholder="">
		</fieldset>

		<fieldset class="flex-column">
			<h3>5</h3>
			<label for="title-mission-5">Titre du bloc mission :</label>
			<input type="text" placeholder="" id="title-mission-5" name="title-mission-5">
			<label for="text-mission-5">Texte du bloc mission :</label>
			<textarea name="text-mission-5" id="text-mission-5" cols="30" rows="5"></textarea>
			<label for="order_mission_5">Ordre</label>
			<input type="number" min="1" max="100" id="order-mission-5" name="order-mission-5" placeholder="">
		</fieldset>

		<hr>

		<fieldset class="flex-column">
			<h3>6</h3>
			<label for="title-mission-6">Titre du bloc mission :</label>
			<input type="text" placeholder="" id="title-mission-6" name="title-mission-6">
			<label for="text-mission-6">Texte du bloc mission :</label>
			<textarea name="text-mission-6" id="text-mission-6" cols="30" rows="5"></textarea>
			<label for="order_mission_6">Ordre</label>
			<input type="number" min="1" max="100" id="order-mission-6" name="order-mission-4" placeholder="">
		</fieldset>

		<input id="submitMissions" type="submit" value="Enregistrer les blocs missions">


		</form>

		

	</section>

<?php }