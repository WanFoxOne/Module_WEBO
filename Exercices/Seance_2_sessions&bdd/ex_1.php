<?php

// Fonction de démarrage des sessions
function fct_session_start() {
    session_name("WEBO");
    session_start();
}

// Si aucune session n'est encore en action
if(session_id() == '' || !isset($_SESSION))
{
    // Initialiser la session
    fct_session_start();
}

// Si l'utilisateur souhaite se connecter
if(isset($_GET['init']) && $_GET['init'] == "true")
{
    // Initialiser la variable de connexion
    $_SESSION['statut_session'] = true;
}

// Si l'utilisateur souhaite se déconnecter
if(isset($_GET['destroy']) && $_GET['destroy'] == "true")
{
    // Destruction de toutes les variables de sessions
    unset($_SESSION);

    // Destruction de la session
    session_destroy();

    // Recherche et suppression du cookie de la session
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), null, time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
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
    <title>Exercice 1</title>
    <meta name="description" content="Module WEBO"/>

    <!-- CSS
        ───────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────── -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.30/css/uikit.min.css"/>

    <!-- Scripts prioritaires
        ───────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────── -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.30/js/uikit.min.js"></script>

    <style>

    </style>

</head>

<body>

    <div class="uk-container uk-margin-top">

        <div class="uk-card uk-card-secondary uk-card-body">
            <h3 class="uk-card-title">WEBO S2 Exercice_1 - Sessions</h3>

            <a href="?init=true"><button type="button" class="uk-button uk-button-secondary">Démarrer une session</button></a>
            <a href="?destroy=true"><button type="button" class="uk-button uk-button-secondary">Détruire une session</button></a>
            <a href="?"><button type="button" class="uk-button uk-button-primary">Recharger</button></a>

        </div>

        <div id="interpretation" class="uk-card uk-card-primary uk-card-body">
            <p><?= (isset($_SESSION['statut_session'])) ? "<span class=\"uk-label\">Connecté</span>" : "<span class=\"uk-label\">Déconnecté</span>"; ?></p>
            <hr>
            <p>Statut de la session : <?= (isset($_SESSION)) ? "true" : "false"; ?></p>
            <p>Id de la session : <?= (isset($_SESSION)) ? session_id() : "no data"; ?></p>
            <p>Time : <?= microtime() ?></p>
        </div>

    </div>


</body>

</html>