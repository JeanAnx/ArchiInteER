<?php

function openDatabase() {

	$user = 'root';
	$pass = 'm12gi8gefxJWJRGs';
	$db = new PDO('mysql:host=localhost;dbname=siteemilie' , $user , $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	$db->exec('SET NAMES UTF8');

	return $db;
}

require 'tools.php';
require 'dbImages.php';
require 'dbIntro.php';
require 'dbProjects.php';
require 'dbAdmin.php';


