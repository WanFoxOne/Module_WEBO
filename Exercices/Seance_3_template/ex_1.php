<?php

include('template.php');

$template = new Template("./");

$template->set_filenames( array('body' => 'template_ex_1.tpl'));

// Connexion à la DB
$db = new PDO('mysql:host=localhost;dbname=webo', 'corler1u', 'ohtooYei1y');

// Statement SQL
$sql = "SELECT id, author, message, published_time FROM messages";

// Requête à la DB
$stmt = $db->query($sql);

// Traitement du résultat de la requête DB
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    $template->assign_block_vars('message', array(
        'ID' => (int)($row['id']),
        'AUTHOR' => (string)stripslashes($row['author']),
        'MESSAGE' => (string)stripslashes($row['message']),
        'PUBLISHED_TIME'  => (string)$row['published_time']

    ));
}

$template->pparse('body');
?>
