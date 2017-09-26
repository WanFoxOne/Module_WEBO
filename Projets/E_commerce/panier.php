<?php


// ----------------------------------------------------------------------------


require_once '../../../vendor/autoload.php';

session_start();
$_SESSION['Connected'] = true;

if(!isset($_SESSION['Panier']))
{
    $_SESSION['Panier'] = [];
}


// ----------------------------------------------------------------------------


// Dossier contenant les templates
$loader = new Twig_Loader_Filesystem('Templates');

// Initialisation du moteur Twig
$twig = new Twig_Environment($loader, array(
    'cache' => false
));

// Récupération du template
$template = $twig->loadTemplate('panier.twig');


// ----------------------------------------------------------------------------


// Connexion à la DB
$db = new PDO('mysql:host=localhost;dbname=webo_ecommerce', 'corler1u', 'ohtooYei1y');


// ----------------------------------------------------------------------------


$addarticle = @$_GET['addarticle'];

if(isset($addarticle)) {
    array_push($_SESSION['Panier'], (int)$addarticle);
    header("Location: " . strtok($_SERVER["REQUEST_URI"],'?'));
    exit();
}

$delarticle = @$_GET['delarticle'];

if(isset($delarticle)) {
    unset($_SESSION['Panier'][$delarticle]);
    $_SESSION['Panier'] = array_values($_SESSION['Panier']);
    header("Location: " . strtok($_SERVER["REQUEST_URI"],'?'));
    exit();
}

$articles_panier = [];

if($_SESSION['Panier'] !== [])
{
    foreach ($_SESSION['Panier'] as $key => $data) {
        $sql = "SELECT id, nom, prix FROM `articles` WHERE id = :id";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $data);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        array_push($articles_panier, ["id" => $row['id'], "nom" => $row['nom'], "prix" => $row['prix'], "id_panier" => $key]);
    }
}

// ----------------------------------------------------------------------------


// Statement SQL
$sql = "SELECT nom, prix, image_url FROM `articles`";

// Requête à la DB
$stmt = $db->prepare($sql);
$stmt->execute();

$dumps = [
    "BDD" => $db->getAttribute(PDO::ATTR_CONNECTION_STATUS),
    "Connected" => $_SESSION['Connected'],
    "ID Session" => session_id(),
    "Panier" => json_encode($_SESSION['Panier'])
];

echo $template->render(array(

    'url_img_logo' => 'medias/imgs/logo.png',

    'url_page_index' => 'index.php',
    'url_page_panier' => 'panier.php',

    'articles_panier' => $articles_panier,

    'dumps' => $dumps
));