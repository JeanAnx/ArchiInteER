<?php 
session_start();

include 'db.php';



if (!empty($_POST)) {

	var_dump($_POST);
	var_dump($_SESSION);

	$admin = getAdmin($_POST['login']);

			var_dump($admin);

			if (empty($admin)) {

				$_SESSION['admin'] = "error";
				header('Location: ../login.php');


				} else if (password_verify($_POST['password'],$admin['password'])) {

						$_SESSION['admin'] = "yes";
						header('Location: ../admin.php');

						} else {

							$_SESSION['admin'] = "error";
							header('Location: ../login.php');

							}

	} else {

		header('Location: ../login.php');
	

}


/*

Ancien contenu du login.php

include 'model/db.php';

var_dump($_POST);

if (isset($_POST['login'])) {

	$admin = getAdmin($_POST['login']);

	var_dump($admin);

	if (empty($admin)) {

		echo "<h2>OUPS utilisateur inconnu</h2>";
	
		} else {
	
			if ($_POST['password'] == $admin['password']) {
	
				echo "<h2>Bienvenue Émilie</h2>";
				$_SESSION = $admin;
				$_SESSION['admin']=="yes";
				header('Location : admin.php');
				exit;
	
				} else {
	
					echo "Le mot de passe ne correspond pas";
	
					}
	
	}


}
 */