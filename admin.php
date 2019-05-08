<?php
session_start();
require_once 'model/db.php';

$intro = getIntro();
$projets = getAllProjects();

if ($_SESSION['admin'] != "yes") {
    header('Location: login');
} else {
    $_SESSION['name'] = 'Admin';
    include_once 'view/adminView.phtml';
}
