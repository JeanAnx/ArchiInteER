<?php

require_once 'model/db.php';

	$allPublishedProjects = getPublishedProjects();

	include 'view/projectsView.phtml';
