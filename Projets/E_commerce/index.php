<?php


// ----------------------------------------------------------------------------


require_once '../../../vendor/autoload.php';

session_start();
$_SESSION['Connected'] = true;
$_SESSION['Id_client'] = 1;

if(!isset($_SESSION['Panier']))
{
    $_SESSION['Panier'] = null;
}


// ----------------------------------------------------------------------------


// Dossier contenant les templates
$loader = new Twig_Loader_Filesystem('Templates');

// Initialisation du moteur Twig
$twig = new Twig_Environment($loader, array(
    'cache' => false
));

// Récupération du template
$template = $twig->loadTemplate('index.twig');


// ----------------------------------------------------------------------------


// Connexion à la DB
$db = new PDO('mysql:host=localhost;dbname=webo_ecommerce', 'corler1u', 'ohtooYei1y');

// Statement SQL
$sql = "SELECT id, nom, prix, image_url FROM `articles`";

// Requête à la DB
$stmt = $db->prepare($sql);
$stmt->execute();

// Traitement du résultat de la requête DB
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

$dumps = [
    "BDD" => $db->getAttribute(PDO::ATTR_CONNECTION_STATUS),
    "Connected" => $_SESSION['Connected'],
    "ID client" => $_SESSION['Id_client'],
    "ID Session" => session_id(),
    "Panier" => $_SESSION['Panier']
];

echo $template->render(array(

    'url_img_logo' => 'medias/imgs/logo.png',

    'url_page_index' => 'index.php',
    'url_page_panier' => 'panier.php',

    'articles' => $articles,

    'dumps' => $dumps


));