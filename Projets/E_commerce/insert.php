<?php

session_start();

// Connexion à la DB
$db = new PDO('mysql:host=localhost;dbname=webo_ecommerce', 'corler1u', 'ohtooYei1y');

$sql = "INSERT INTO commandes SET client = :client";

$stmt = $db->prepare($sql);
$stmt->bindParam(":client", $_POST['client'], PDO::PARAM_STR);
$stmt->execute();

$id_commande = $db ->lastInsertId();

foreach ($_SESSION['Panier'] as $key => $data)
{
    $sql = "INSERT INTO details SET id_commande = :id_commande, id_article = :id_article";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":id_commande", $id_commande, PDO::PARAM_INT);
    $stmt->bindParam(":id_article", $data);
    $stmt->execute();
}

$_SESSION['Panier'] = [];
header("Location: index.php");
exit();