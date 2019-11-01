<?php 
require_once 'model/db.php';

var_dump($_FILES);
// Envoi du tite en bdd.
if (isset($_POST['title']) && isset($_POST['title']) != "") {
    setTitleInspirations($_POST['title']);
}
// Envoi du texte en bdd.
if (isset($_POST['text']) && isset($_POST['text']) != "") {
    setTextInspirations($_POST['text']);
}
// Envoi des images sur le serveur.
if (isset($_FILES['images']) && !empty($_FILES['images'])) {
    $images = [];
    for ($i=0; $i < count($_FILES['images']['name']); $i++) { 
        $images[$i] = [
            'name' => $_FILES['images']['name'][$i],
            'type' => $_FILES['images']['type'][$i],
            'tmp_name' => $_FILES['images']['tmp_name'][$i],
            'error' => $_FILES['images']['error'][$i],
            'size' => $_FILES['images']['size'][$i],
        ];
    }
    uploadImagesInspirations($images);
}

// $images_inspirations = getImagesInspirations();
$texte_inspirations = getTextInspirations()['text'];
$titre_inspirations = getTitleInspirations()['titre'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../css/normalize.css">
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
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <title>Modifier la page "Inspirations"</title>
</head>

<body>

<main id="blocAdmin">

    <div class="articleTools">
        <a href="admin.php">Retour à l'accueil</a>
    </div>


<!-- MODIF TEXTE INSPIRATIONS -->

    <section id="inspirations-text-edit">

		<h1 class="align-center">- Modifier le texte de la page "Inspirations" -</h1>
        <form class="introForm" action="" method="post">

			<label for="text">Titre actuel :</label>
			<input name="title" id="title">
			<input type="submit" value="Modifier">
		</form>


		<form class="introForm" action="" method="post">

			<label for="text align-center">Texte actuel :</label>
			<textarea name="text" id="text" cols="30" rows="60"><?= $texte_inspirations ?></textarea>
			<input type="submit" value="Modifier">
		</form>

	</section>

    <!-- MODIF IMAGES INSPIRATIONS -->

    <form class="imagesForm" action="" method="POST" enctype="multipart/form-data">

        <label for="imagesText">Modifier les images de la galerie (2 Mo maximum):</label>
        <input type="file" name="images[]" multiple>

        <input  id="imagesProjectSubmit" type="submit" value="Ajouter">

    <div class="galerie-inspirations container gallery-container">
            
        <div class="tz-gallery">

            <div class="fluid-gallery">

                    <div class="double">
                        <a class="lightbox" href="visuels/archi-1.jpg">
                            <img src="visuels/archi-1.jpg" alt="">
                        </a>
                        <a class="lightbox" href="visuels/archi-1.jpg">
                            <img src="visuels/archi-1.jpg" alt="">
                        </a>
                    </div>
                    <div class="single">
                        <a class="lightbox" href="visuels/archi-6.jpg">
                            <img src="visuels/archi-6.jpg" alt="">
                        </a>
                    </div>
                    <div class="double">
                        <a class="lightbox" href="visuels/archi-1.jpg">
                            <img src="visuels/archi-1.jpg" alt="">
                        </a>
                        <a class="lightbox" href="visuels/archi-1.jpg">
                            <img src="visuels/archi-1.jpg" alt="">
                        </a>
                    </div>
                    <div class="single">
                        <a class="lightbox" href="../visuels/archi-6.jpg">
                            <img src="../visuels/archi-6.jpg" alt="">
                        </a>
                    </div>
                    <div class="single">
                        <a class="lightbox" href="../visuels/archi-6.jpg">
                            <img src="../visuels/archi-6.jpg" alt="">
                        </a>
                    </div>
                    <div class="double">
                        <a class="lightbox" href="../visuels/archi-1.jpg">
                            <img src="../visuels/archi-1.jpg" alt="">
                        </a>
                        <a class="lightbox" href="../visuels/archi-1.jpg">
                            <img src="../visuels/archi-1.jpg" alt="">
                        </a>
                    </div>
                    <div class="single">
                        <a class="lightbox" href="../visuels/archi-6.jpg">
                            <img src="../visuels/archi-6.jpg" alt="">
                        </a>
                    </div>
                    <div class="double">
                        <a class="lightbox" href="../visuels/archi-1.jpg">
                            <img src="../visuels/archi-1.jpg" alt="">
                        </a>
                        <a class="lightbox" href="../visuels/archi-1.jpg">
                            <img src="../visuels/archi-1.jpg" alt="">
                        </a>
                    </div>
                    <div class="double">
                        <a class="lightbox" href="../visuels/archi-1.jpg">
                            <img src="../visuels/archi-1.jpg" alt="">
                        </a>
                        <a class="lightbox" href="../visuels/archi-1.jpg">
                            <img src="../visuels/archi-1.jpg" alt="">
                        </a>
                    </div>
                    <div class="single">
                        <a class="lightbox" href="../visuels/archi-6.jpg">
                            <img src="../visuels/archi-6.jpg" alt="">
                        </a>
                    </div>
                    <div class="double">
                        <a class="lightbox" href="../visuels/archi-1.jpg">
                            <img src="../visuels/archi-1.jpg" alt="">
                        </a>
                        <a class="lightbox" href="../visuels/archi-1.jpg">
                            <img src="../visuels/archi-1.jpg" alt="">
                        </a>
                    </div>
                    <div class="single">
                        <a class="lightbox" href="../visuels/archi-6.jpg">
                            <img src="../visuels/archi-6.jpg" alt="">
                        </a>
                    </div>

                    <div class="single">
                        <a class="lightbox" href="../visuels/archi-6.jpg">
                            <img src="../visuels/archi-6.jpg" alt="">
                        </a>
                    </div>
                    <div class="double">
                        <a class="lightbox" href="../visuels/archi-1.jpg">
                            <img src="../visuels/archi-1.jpg" alt="">
                        </a>
                        <a class="lightbox" href="../visuels/archi-1.jpg">
                            <img src="../visuels/archi-1.jpg" alt="">
                        </a>
                    </div>
                    <div class="single">
                        <a class="lightbox" href="../visuels/archi-6.jpg">
                            <img src="../visuels/archi-6.jpg" alt="">
                        </a>
                    </div>
                    <div class="double">
                        <a class="lightbox" href="../visuels/archi-1.jpg">
                            <img src="../visuels/archi-1.jpg" alt="">
                        </a>
                        <a class="lightbox" href="../visuels/archi-1.jpg">
                            <img src="../visuels/archi-1.jpg" alt="">
                        </a>
                    </div>

            </div>

        </div>

    </div>

</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script>
    baguetteBox.run('.tz-gallery');
</script>

</body>

</html>