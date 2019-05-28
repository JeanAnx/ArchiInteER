<?php 
session_start();

if (isset($_SESSION['admin']) && $_SESSION['admin'] == 'yes') {

    require 'model/db.php';


    if (isset($_POST) && !empty($_POST)) {

        $editData = [
            'id' => $_POST['id'],
            'title' => $_POST['title'],
            'galleryText' => $_POST['galleryText'],
            'subtitle' => $_POST['subtitle'],
            'mainText' => $_POST['mainText'],
        ];

        editProject($editData);
        die;




    }




    if (isset($_GET['pid']) && $_GET['pid'] != "") {

    $theProject = getProjectById($_GET['pid']);

    var_dump($theProject);
    var_dump($_POST);
    
    }

    include 'view/projectEditView.phtml';

















}