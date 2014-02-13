<!DOCTYPE html>
<html>
	<?php 
		require_once 'vendors/Twig/lib/Twig/Autoloader.php';

		include 'controllers/empresa.php';

		$empresa = new EmpresaController();

		Twig_Autoloader::register();

		$action = isset($_GET['action']) ? $_GET['action'] : 'index';

		$loader = new Twig_Loader_Filesystem('view');

		$twig = new Twig_Environment($loader, array('debug' => true,));
		$twig->addExtension(new Twig_Extension_Debug());

		echo $twig->render('index.twig',$empresa->index());
	?>
</html>