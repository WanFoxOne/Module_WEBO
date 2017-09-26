<?php

// Connexion à la DB
$db = new PDO('mysql:host=localhost;dbname=webo_ecommerce', 'corler1u', 'ohtooYei1y');

// Statement SQL
$sql = "SELECT id, client FROM `commandes`";

// Requête à la DB
$stmt = $db->query($sql);

echo '<ul>';

while (list($id_commande, $client) = $stmt->fetch())
{
    echo '<li>' . $client;

    // Statement SQL
    $sql2 = "SELECT * FROM details 
                JOIN articles ON details.id_article = articles.id 
                WHERE id_commande = : id_commande";

    // Requête à la DB
    $stmt2 = $db->prepare($sql2);
    $stmt2->bindParam(':id_commande', $id_commande, PDO::PARAM_INT);
    $stmt2->execute();

    echo '<ul>';

    while (list($nom) = $stmt2->fetch())
    {
        echo '<li>' . $nom . '</li>';
    }

    echo '</ul>';

}

echo '</ul>';