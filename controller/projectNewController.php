<?php 

require_once '../model/db.php';

var_dump($_POST);

$newData = [];


$newData = [
    'title' => $_POST['title'],
    'galleryText' => $_POST['galleryText'],
    'subtitle' => $_POST['subtitle'],
    'mainText' => $_POST['text'],
];


if (!isset($_POST['published'])) {
    $newData['published'] = 0;
} else {
    $newData['published'] = true;
}

if (createProject($newData)) {
    header("Location: ../model/images.php");
} else {
    $_SESSION['error'] = 'projet';
    header("Location: ../admin.php");
}