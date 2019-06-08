<?php 
session_start();
require_once 'db.php';
$newIntro = $_POST['newIntro'];
var_dump($newIntro);

if (isset($_SESSION) && !empty($_SESSION) && $_SESSION['admin'] == 'yes') {

    setIntro($newIntro);
    $_SESSION['messages'][] = '<h2 class="successMessage"> <i class="fas fa-check"></i> L\'intro a bien été modifiée </h2>';
    header('Location: ../admin.php');

} else {

    header('Location: ../index.php');

}
