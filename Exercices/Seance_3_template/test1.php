<?php

include('template.php');

// Connexion à la DB
$db = new PDO('mysql:host=localhost;dbname=webo', 'corler1u', 'ohtooYei1y');

// Statement SQL
$sql = "SELECT pseudo, email FROM table_users WHERE id = 1";

// Requête à la DB
$stmt = $db->prepare($sql);
$stmt->execute();

// Traitement du résultat de la requête DB
$row = $stmt->fetch(PDO::FETCH_ASSOC);


//  On initialise la classe.
//  La méthode Template prend comme argument facultatif le chemin vers
//  les modèles. Ici, on indique que les modèles se trouvent dans le dossier courant
$template = new Template("./");

// On indique le modèle à utiliser, ici, template1.tpl, auquel on affecte le nom body
$template->set_filenames( array('body' => 'template1.tpl'));

//  Le passage le plus important, on affecte les données aux variables
//  qui se trouvent dans le fichier template1.tpl.
//  Littéralement, ça donne ça :
$template->assign_vars( array(
    'PSEUDO' => stripslashes($row['pseudo']),
    'EMAIL'  => $row['email']
));

//  Le moteur de templates fait tous les traitements adéquats et affiche le résultat.
$template->pparse('body');
?>

