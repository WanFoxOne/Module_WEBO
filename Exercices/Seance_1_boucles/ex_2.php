<!DOCTYPE html>
<html lang="fr">

<head>

    <!-- Paramètres généraux
        ───────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────── -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="content-language" content="fr"/>
    <meta name="author" content="CORLER Damien"/>

    <!-- Paramètres spécifiques
        ───────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────── -->
    <title>Exercice 1</title>
    <meta name="description" content="Module WEBO"/>

    <style>
        li {
            margin-bottom: 2px;
            list-style: none;
        }
        .dir {
            background-color: rgba(210, 105, 30, 0.66);
            font-weight: bold;
            padding: 4px;
        }
        .file {
            background-color: rgba(119, 210, 90, 0.66);
        }
    </style>

</head>

<body>


    <?php

    function dirToArray($dir) {

        // Si le lien dirige vers un répertoire
        if(is_dir($dir)) {

            // Ouvrir le répertoire
            if ($dir_open = opendir($dir)) {

                echo '<ul>';

                // Liste des éléments du répertoire
                while (false !== ($file = readdir($dir_open))) {

                    // Exclure les fichiers systèmes
                    if($file != "." && $file != "..") {

                        // Si l'élément est un dossier
                        if(is_dir($dir.$file)) {

                            echo "<li class='dir'>$file</li>";

                            // Exploration du dossier
                            dirToArray($dir.$file."/");

                        } else {

                            echo "<li class='file'>$file</li>";
                        }
                    }
                }

                echo '</ul>';

                // Fermer le répertoire
                closedir($dir_open);
            }
        }

    }

    dirToArray('../../');

    ?>

</body>

</html>

<?php



