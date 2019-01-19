<?php
session_start();
require '../model/db.php';

if ($_SESSION['admin'] == 'yes') {

    $admin = getAdmin($_SESSION['name']);
    echo 'Admin :';
    var_dump($admin);

    echo 'SESSION';
    var_dump($_SESSION);

    echo 'POST';
    var_dump($_POST);

    require_once '../model/db.php';

    if (isset($_POST['password']) && isset($_POST['newPassword']) && isset($_POST['newPasswordConfirm'])) {
        
        $inputPassword = htmlentities($_POST['password']);
        $newPassword = htmlentities($_POST['newPassword']);
        $newPasswordConfirm = htmlentities($_POST['newPasswordConfirm']);
        $hash = $admin['password'];

        var_dump($inputPassword);
        var_dump($admin['password']);
        var_dump(password_verify($inputPassword,$hash));

        if (password_verify($inputPassword,$hash) && $newPassword == $newPasswordConfirm) {

            echo 'ça matche';
            $newPasswordHash = password_hash($newPassword,PASSWORD_BCRYPT);
            changePassword($admin['login'],$newPasswordHash);
            header('Location: ../admin.php');       

        } else {
            echo '<h3>Une erreur s\'est produite. Veuillez réessayer</h3>';
        }

    } else {
        
        echo 'ERREUR';

    }




}