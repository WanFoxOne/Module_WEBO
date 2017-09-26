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
    <link rel="stylesheet" href="../../../vendor/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="../../../vendor/uikit/css/uikit.min.css"/>

    <!-- Scripts prioritaires
        ───────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────────── -->
    <script src="../../../vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="../../../vendor/uikit/js/uikit.min.js"></script>

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
            </tr>
            </thead>

            <tbody>
            <!-- BEGIN message -->
                <tr>
                    <td>{message.ID}</td>
                    <td>{message.AUTHOR}</td>
                    <td>{message.MESSAGE}</td>
                    <td>{message.PUBLISHED_TIME}</td>
                </tr>
            <!-- END message -->
            </tbody>

        </table>
    </div>

</div>


</body>

</html>