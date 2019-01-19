<?php
session_start();
require_once 'model/db.php';

$projets = getProjects();

if ($_SESSION['admin'] != "yes") {
    header('Location: login.php');
} else {
    $_SESSION['name'] = 'Admin';
    var_dump($_SESSION);

    include_once 'view/adminView.phtml';
}
