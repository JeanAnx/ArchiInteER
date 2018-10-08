<?php 

include 'model/db.php';

var_dump($_POST);

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