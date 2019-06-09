<?php
session_start();
var_dump($_GET);

if ($_SESSION['admin'] == 'yes') {

    require 'db.php';

    if (isset($_GET['pid']) && $_GET['pid'] != "") {

    togglePublishProject($_GET['pid']);

    $_SESSION['messages'][] = '<h2 class="successMessage">Modification effectuée</h2>';
    header('Location: ../admin.php');

    } else {

    header('Location: ../admin.php?error=yes');

    }

} else {
    header('Location:index.php');
}