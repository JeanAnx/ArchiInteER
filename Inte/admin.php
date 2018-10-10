<?php 

include 'model/db.php';

var_dump($_POST);

if (!empty($_POST)) {

	$admin = getAdmin($_POST['login']);
	$_SESSION = $admin;

			var_dump($admin);

			if (empty($admin)) {

			echo "<h2>OUPS utilisateur inconnu</h2>";
			include 'view/loginView.phtml';
			exit;

				} if ($_POST['password'] == $admin['password']) {

						echo "<h2>Bienvenue Émilie</h2>";

						$_SESSION['admin'] = "yes";

						include 'view/adminView.phtml';
						exit;

						} else {

							echo "Le mot de passe ne correspond pas";
							include 'view/loginView.phtml';

							}

	} else {

		include 'view/loginView.phtml';
		exit;

}

$projets = getProjects();
