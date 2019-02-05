<?php

if (isset($_SESSION['admin']) && $_SESSION['admin'] == 'yes') {
session_start();
}

require_once 'model/db.php';

	$allPublishedProjects = getPublishedProjects();

	include 'view/projectsView.phtml';
