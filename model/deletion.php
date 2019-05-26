<?php 
session_start();

require 'db.php';

if ($_SESSION['admin'] == 'yes') {

var_dump($_GET);
    // Si l'id est bien envoyé en GET
    if (isset($_GET['pdid']) && $_GET['pdid'] != "") {
        $thisProject = getProjectById($_GET['pdid']);
            // Et s'il renvoie bien à un projet existant
            if (isset($thisProject['id']) && $thisProject['id'] != "") {
            deleteProject($thisProject['id']);
            $_SESSION['projet'] = 'deleted';
            header('Location: ../admin.php');
        } else {
            $_SESSION['error'] = 'projet';
            header('Location: ../admin.php');
        }
    }
}
