<?php

require_once '../../vendor/autoload.php';

// Dossier contenant les templates
$loader = new Twig_Loader_Filesystem('Templates');

// Initialisation du moteur Twig
$twig = new Twig_Environment($loader, array(
    'cache' => false
));

// Récupération du template
$template = $twig->loadTemplate('index.twig');

// Assignation
echo $template->render(array(

    'moteur_name' => 'Twig'

));