<?php 
session_start();

if (isset($_SESSION['admin']) && $_SESSION['admin'] == 'yes') {

    require 'db.php';
    if (isset($_FILES['imageIntro']) && $_FILES['imageIntro']['name'] != "") {

        uploadImageIntro($_FILES['imageIntro']);
        sendImageIntro($_FILES['imageIntro']['name']);

        $_SESSION['messages'][] = "<h2 class='successMessage'>Image d'intro modifiée</h2>";
        header('Location: ../admin.php#introImageEdit');

    }

} else {
    header('Location: ../index.php');
}