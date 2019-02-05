<?php 
session_start();
require_once 'db.php';
$newIntro = $_POST['newIntro'];
var_dump($newIntro);

if (isset($_SESSION) && !empty($_SESSION) && $_SESSION['admin'] == 'yes') {

    setIntro($newIntro);
    $_SESSION['intro'] = 'ok';
    header('Location: ../admin.php');

} else {

    header('Location: ../index.php');

}
