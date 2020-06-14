<?php 

require 'model/db.php';

$pid = $_GET['n'];

$theProject = getProjectById($pid);

if (!$theProject) {
    header('Location: index.php');
}

$theProject['imagesArticle'] = explode(',' , $theProject['imagesArticle']);
$theProject['imagesTextArticle'] = explode(',' , $theProject['imagesTextArticle']);


include 'view/theProjectView.phtml';
