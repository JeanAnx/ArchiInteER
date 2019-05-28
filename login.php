<?php 
session_start();

include_once 'view/loginView.phtml';

if (isset($_SESSION['admin']) && $_SESSION['admin'] == 'error') {
	echo '<h2>Oups, une erreur s\'est produite</h2>';
}
