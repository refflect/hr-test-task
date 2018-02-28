<?php

define('PathPrefix', '../controllers/');
define('PathPostfix', 'Controller.php');

//>Templates
$template = 'default';
define('TemplatePath', "../views/{$template}/");
define('TemplateWebPath', "/templates/{$template}/");

require_once '../lib/vendor/autoload.php';

$loader = new Twig_Loader_Filesystem(TemplatePath);
$twig = new Twig_Environment($loader, array(
    'cache' => false, // '../tmp/twig/templates_c',
));
$twig->addGlobal('TemplatePath', TemplateWebPath);

//<
