<?php 

require 'model/db.php';

$pid = $_GET['n'];

$theProject = getProjectById($pid);

if (!$theProject) {
    header('Location: index.php');
}

$theProject['imagesArticle'] = explode(',' , $theProject['imagesArticle']);

include 'view/theProjectView.phtml';
