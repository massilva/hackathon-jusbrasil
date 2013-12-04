<?php 	

include_once "../vendors/swift/lib/swift_required.php";
require_once '../vendors/Twig/lib/Twig/Autoloader.php';
require_once "../model/empresaModel.php";

Twig_Autoloader::register();

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// $loader = new Twig_Loader_String();
$loader = new Twig_Loader_Filesystem('../view');
$twig = new Twig_Environment($loader);

if ($action === 'index')
	index();

function index()
{
	global $twig;
	echo $twig->render('index.twig');
}

?>