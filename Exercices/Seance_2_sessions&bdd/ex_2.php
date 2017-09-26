<?php


// Initialisation d'une session
session_name("WEBO");
session_start();


// Connexion à la base de données
$db = mysqli_connect(
        'localhost',
        'corler1u',
        'ohtooYei1y',
        'webo'
    ) or die('Erreur de connexion (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());


// Ajout d'un enregistrement
$author = htmlspecialchars(addslashes(@$_POST['author']));
$message = strip_tags(addslashes(@$_POST['message']), '<p><b><i><u>');
$sup = (int) @$_GET['sup'];
$mod = (int) @$_POST['mod'];
$getMod = (int) @$_GET['getMod'];
$tokenGet = @$_GET['token'];

// Ajout ou modification d'un message dans la base de données
if(!empty($author) && !empty($message))
{
    // Modification
    if(!empty($mod))
    {
        mysqli_query($db, "
            UPDATE messages
            SET message='$message', author='$author'
            WHERE id=$mod
        ") or die(mysqli_errno($db) . " // " . mysqli_error($db));

    }
    // Ajout
    else {
        mysqli_query($db, "
          INSERT INTO messages 
          SET author='$author', message='$message'
        ") or die(mysqli_errno($db) . " // " . mysqli_error($db));

    }

    header("Location: " . strtok($_SERVER["REQUEST_URI"],'?'));
    exit();
}


// Suppression d'un message de la base de données
if(!empty($sup) && $_SESSION['token'] === $tokenGet)
{
    mysqli_query($db, "
        DELETE FROM messages
        WHERE id = $sup
    ") or die(mysqli_errno($db) . " // " . mysqli_error($db));

    header("Location: " . strtok($_SERVER["REQUEST_URI"],'?'));
    exit();
}


// Récupération d'un message spécifique la base de données
$modResult = null;

if(!empty($getMod) && empty($mod) && $_SESSION['token'] === $tokenGet)
{
    $result = mysqli_query($db, "
        SELECT id, author, message
        FROM messages
        WHERE id = $getMod
    ") or die(mysqli_errno($db) . " // " . mysqli_error($db));

    $modResult = (mysqli_fetch_assoc($result));
}


?>
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
    <title>Exercice 2</title>
    <meta name="description" content="Module WEBO"/>

    <!-- CSS
        ───────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────── -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.30/css/uikit.min.css"/>

    <!-- Scripts prioritaires
        ───────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────── -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.30/js/uikit.min.js"></script>

</head>

<body>

<div class="uk-container uk-margin-top">

    <div class="uk-card uk-card-secondary uk-card-small uk-card-body">

        <h1 class="uk-card-title">Messages enregistrés</h1>

        <table class="uk-table uk-table-striped">

            <thead>
                <tr>
                    <th class="uk-background-primary">Id</th>
                    <th>Author</th>
                    <th>Message</th>
                    <th>Published_time</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>

            <?php

            $result = mysqli_query($db, "SELECT id, author, message, published_time FROM messages") or die("Erreur requête");

            $token = uniqid();
            $_SESSION['token'] = $token;

            while (list($id, $author, $message, $dateheure) = mysqli_fetch_array($result)) {
                echo
                    '<tr>' .
                    '<td>' . $id .'</td>' .
                    '<td>' . $author .'</td>' .
                    '<td>' . $message .'</td>' .
                    '<td>' . $dateheure .'</td>' .
                    '<td><a href="?getMod=' . $id . '&token=' . $token . '"><i class="fa fa-edit" aria-hidden="true"></i></a></td>' .
                    '<td><a href="?sup=' . $id . '&token=' . $token . '"><i class="fa fa-times" aria-hidden="true"></i></a></td>' .
                    '</tr>';
            }

            ?>

            </tbody>

        </table>
    </div>


    <div class="uk-card uk-card-primary uk-card-small uk-card-body">
        <form action="?test=1" method="post">
            <fieldset class="uk-fieldset">

                <legend class="uk-legend"><?= (!is_null($modResult)) ? "Modification du message (ID : " . $modResult['id'] . " )" : "Ajout d'un message"; ?></legend>

                <div class="uk-margin">
                    <input name="author" class="uk-input" type="text" placeholder="Nom d'utilisateur..." value="<?= (!is_null($modResult)) ? $modResult['author'] : ""; ?>" required>
                </div>

                <div class="uk-margin">
                    <textarea name="message" class="uk-textarea" rows="5" placeholder="Message..." required style="resize: vertical;min-height: 40px;"><?= (!is_null($modResult)) ? $modResult['message'] : ""; ?></textarea>
                </div>

                <?= (!is_null($modResult)) ? "<input type=\"hidden\" name=\"mod\" value=\"".$modResult['id'] . "\">" : ""; ?>

                <button type="submit" class="uk-button uk-button-default">Envoyer</button>
                <a href="<?= strtok($_SERVER["REQUEST_URI"],'?'); ?>"><button type="button" class="uk-button uk-button-default">Reset</button></a>

            </fieldset>
        </form>
    </div>

</div>


</body>

</html>