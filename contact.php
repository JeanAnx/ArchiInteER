<?php 
session_start();

require 'model/db.php';

$infos = [];

foreach ($_POST as $row) {
    if ($row == "" || $row == " ") {
        $row = "Non renseigné";
    }
    // If attempting to send file, GTFO.
    if (strpos($row, "#") === FALSE) {
        $infos[] = clean($row);
    }
}

$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$mail = 
"<html><body>" .
"<h2>Message de " . $infos[0] . " " . $infos[1] . " : </h2>"
. "<h2>Téléphone : " . $infos[6] . " / Email : " . $infos[2] . " </h2>"
. "<h3>Adresse : " . $infos[3] . " / " . $infos[4] . " / " . $infos[5] . "</h3>"
. "<h3>Objet : " . $infos[7] . "</h3>"
. "<h3>Message : " . $infos[8] . "</h3>"
."</body></html>";
$_SESSION['messages'][] = '<h2 class="message" style="text-align:center;color:green">Votre message a bien été envoyé </h2>';
mail('jean.annaix@gmail.com',$_POST['objet'],$mail,$headers);
header('Location: index.php?p=contact');
