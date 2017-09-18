<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=bdd_1', 'root', '');
    //echo('BDD : Connexion ok !');
} catch (PDOException $e) {
    die('Connexion échouée : ' . $e->getMessage());
}

/*$arrayForTest = ["", " ", false, true, array(), null, "0", 0, 0.0, "\0"];

echo '<table><tr><td>isset()</td><td>empty()</td><td>is_null()</td></tr>';

foreach ($arrayForTest as $key => $data) {
    echo '<tr>';

    echo (isset($data)) ? '<td>true</td>' : '<td>---</td>';
    echo (!empty($data)) ? '<td>true</td>' : '<td>---</td>';
    echo (is_null($data)) ? '<td>true</td>' : '<td>---</td>';

    echo '</tr>';
}

echo '</table>';*/

$a = 1;
echo (++$a == 2) ? '<p>true</p>' : '<p>---</p>';
echo ($a++ == 2) ? '<p>true</p>' : '<p>---</p>';