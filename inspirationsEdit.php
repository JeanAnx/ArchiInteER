<?php 
session_start();
if ($_SESSION['admin'] == 'yes') {
    require_once 'model/db.php';

    // Traitement d'une image à supprimer.
    if (isset($_GET['did']) && $_GET['did'] != "") {
        deleteImageInspirations(($_GET['did']));
    }
    // Envoi du tite en bdd.
    if (isset($_POST['title']) && $_POST['title'] != "") {
        setTitleInspirations($_POST['title']);
    }
    // Envoi du texte en bdd.
    if (isset($_POST['text']) && $_POST['text'] != "") {
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
        // Et en bdd.
        $imagesNames = implode("," , $_FILES['images']['name']);
        sendImagesInspirations(trim($imagesNames,','));
    }

    $images_inspirations = explode("," , getImagesInspirations()['list']);
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
                <textarea name="title" id="title" cols="30" rows="60"><?= $titre_inspirations ?></textarea>
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

            <?php if (count($images_inspirations) < 24) { ?>
            <input  id="imagesProjectSubmit" type="submit" value="Ajouter">
            <?php } ?>
        <div class="galerie-inspirations container gallery-container">
                
            <div class="tz-gallery">

                <div class="fluid-gallery">

                        <div class="double">
                            <?php if (isset($images_inspirations[0]) && $images_inspirations[0] != "") { ?>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[0]?>">
                                <img src="img/imagesInspirations/<?= $images_inspirations[0]?>" alt="<?= $images_inspirations[0]?>">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[0]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>
                            <?php if (isset($images_inspirations[1])) { ?>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[1]?>">
                                <img src="img/imagesInspirations/<?= $images_inspirations[1]?>" alt="<?= $images_inspirations[1]?>">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[1]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>

                        </div>
                        <div class="single">
                            <?php if (isset($images_inspirations[2])) { ?>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[2]?>"><i class="fas fa-trash-alt"></i></a>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[2]?>">
                                <img src="img/imagesInspirations/<?= $images_inspirations[2]?>" alt="">
                            </a>
                            <?php } ?>
                        </div>
                        <div class="double">
                            <?php if (isset($images_inspirations[3])) { ?>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[3]?>">
                                <img src="img/imagesInspirations/<?= $images_inspirations[3]?>" alt="">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[3]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>
                            <?php if (isset($images_inspirations[4])) { ?>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[4]?>">
                                <img src="img/imagesInspirations/<?= $images_inspirations[4]?>" alt="">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[4]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>

                        </div>
                        <div class="single">
                            <?php if (isset($images_inspirations[5])) { ?>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[5]?>g">
                                <img src="img/imagesInspirations/<?= $images_inspirations[5]?>" alt="">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[5]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>

                        </div>
                        <div class="single">
                            <?php if (isset($images_inspirations[6])) { ?>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[6]?>">
                                <img src="img/imagesInspirations/<?= $images_inspirations[6]?>" alt="">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[6]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>

                        </div>
                        <div class="double">
                            <?php if (isset($images_inspirations[7])) { ?>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[7]?>">
                                <img src="img/imagesInspirations/<?= $images_inspirations[7]?>" alt="">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[7]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>
                            <?php if (isset($images_inspirations[8])) { ?>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[8]?>">
                                <img src="img/imagesInspirations/<?= $images_inspirations[8]?>" alt="">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[8]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>

                        </div>
                        <div class="single">
                            <?php if (isset($images_inspirations[9])) { ?>

                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[9]?>">
                                <img src="img/imagesInspirations/<?= $images_inspirations[9]?>" alt="">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[9]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>

                        </div>
                        <div class="double">
                            <?php if (isset($images_inspirations[10])) { ?>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[10]?>">
                                <img src="img/imagesInspirations/<?= $images_inspirations[10]?>g" alt="">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[10]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>

                            <?php if (isset($images_inspirations[11])) { ?>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[11]?>.jpg">
                                <img src="img/imagesInspirations/<?= $images_inspirations[11]?>" alt="">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[11]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>

                        </div>
                        <div class="double">
                            <?php if (isset($images_inspirations[12])) { ?>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[12]?>">
                                <img src="img/imagesInspirations/<?= $images_inspirations[12]?>" alt="">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[12]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>
                            <?php if (isset($images_inspirations[13])) { ?>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[13]?>">
                                <img src="img/imagesInspirations/<?= $images_inspirations[13]?>" alt="">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[13]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>

                        </div>
                        <div class="single">
                            <?php if (isset($images_inspirations[14])) { ?>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[14]?>">
                                <img src="img/imagesInspirations/<?= $images_inspirations[14]?>" alt="">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[14]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>

                        </div>
                        <div class="double">
                            <?php if (isset($images_inspirations[15])) { ?>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[15]?>">
                                <img src="img/imagesInspirations/<?= $images_inspirations[15]?>" alt="">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[15]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>
                            <?php if (isset($images_inspirations[16])) { ?>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[16]?>">
                                <img src="img/imagesInspirations/<?= $images_inspirations[16]?>" alt="">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[16]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>

                        </div>
                        <div class="single">
                            <?php if (isset($images_inspirations[17])) { ?>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[17]?>">
                                <img src="img/imagesInspirations/<?= $images_inspirations[17]?>" alt="">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[17]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>

                        </div>

                        <div class="single">
                            <?php if (isset($images_inspirations[18])) { ?>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[18]?>">
                                <img src="img/imagesInspirations/<?= $images_inspirations[18]?>" alt="">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[18]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>

                        </div>
                        <div class="double">
                            <?php if (isset($images_inspirations[19])) { ?>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[19]?>">
                                <img src="img/imagesInspirations/<?= $images_inspirations[19]?>" alt="">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[19]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>
                            
                            <?php if (isset($images_inspirations[20])) { ?>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[20]?>">
                                <img src="img/imagesInspirations/<?= $images_inspirations[20]?>" alt="">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[20]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>

                        </div>
                        <div class="single">
                        <?php if (isset($images_inspirations[21])) { ?>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[21]?>">
                                <img src="img/imagesInspirations/<?= $images_inspirations[21]?>" alt="">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[21]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>

                        </div>
                        <div class="double">
                            <?php if (isset($images_inspirations[22])) { ?>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[22]?>">
                                <img src="img/imagesInspirations/<?= $images_inspirations[22]?>" alt="">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[22]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>
                            <?php if (isset($images_inspirations[23])) { ?>
                            <a class="lightbox" href="img/imagesInspirations/<?= $images_inspirations[23]?>g">
                                <img src="img/imagesInspirations/<?= $images_inspirations[23]?>" alt="">
                            </a>
                            <a class="deleteButtonInspirations" href="?did=<?= $images_inspirations[23]?>"><i class="fas fa-trash-alt"></i></a>
                            <?php } ?>

                        </div>

                </div>

            </div>

        </div>

    </main>

    </body>

    </html>

<?php } else {

    header('Location: ../index.php');

}
