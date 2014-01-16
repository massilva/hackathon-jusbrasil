<?php 	

require_once '../vendors/Twig/lib/Twig/Autoloader.php';
require_once "../model/empresaModel.php";

Twig_Autoloader::register();

$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$loader = new Twig_Loader_Filesystem('../view');
$twig = new Twig_Environment($loader);

$empresa = new empresaModel();

if ($action === 'index')
	index();

function index()
{
	global $twig, $empresa;
	$estados = array();
	$orgaos;
	$motivos = array();
	$mot = $empresa->getMotivo();
	$ranking = $empresa->getDetalheMotivo();

	foreach($mot as $key => $m)
	{
		$motivos[$key]['label'] = utf8_encode($m->tipo_sancao);
		$motivos[$key]['value'] = $m->qtd;
	}

	foreach($ranking as $r)
		$r->tipo_sancao = utf8_encode($r->tipo_sancao);
	
	echo $twig->render('index.twig', array('estados' => $estados, 'orgaos' => $orgaos, 'motivos' => $motivos, 'ranking' => $ranking));
}

?>