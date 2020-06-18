<?php

if (isset($_POST['mentions'])) {

  



};




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

<main id="mentionsEdit">

  <div class="articleTools">
    <a href="admin">Retour à l'accueil</a>
  </div>


  <h2 class="align-center">- Modifier la page "Mentions légales" -</h2>

      <form class="introForm" action="" method="post">

        <label for="newIntro">Texte actuel :</label>
        <textarea name="mentions" id="mentions" cols="30" rows="10"><?= $mentions['texte'] ?></textarea>
        <input type="submit" value="Modifier">
      </form>

</main>


