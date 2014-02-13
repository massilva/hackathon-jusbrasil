<?php 	

require_once "model/empresaModel.php";

class EmpresaController
{
	function index()
	{
		$empresa = new empresaModel();
		
		$orgaos = array();
		$estados = array();
		$estados[0] = array('State','Num. de inidônios');
		$motivos = array();
		$mot = $empresa->getMotivo();
		$ranking = $empresa->getDetalheMotivo();
		$byEstados = $empresa->getInidonioByEstado();

		foreach($mot as $key => $m)
		{
			$motivos[$key]['label'] = utf8_encode($m->tipo_sancao);
			$motivos[$key]['value'] = $m->qtd;
		}

		foreach($byEstados as $key => $obj)
		{
			$estados[($key+1)][] = "BR-".$obj->uf_pessoa;
	    	$estados[($key+1)][] = (int)$obj->qtd;
		}

		$motivos = json_encode($motivos);
		$estados = json_encode($estados);

		foreach($ranking as $r)
			$r->tipo_sancao = utf8_encode($r->tipo_sancao);
		
		$filter = isset($_GET['busca'])? $_GET['busca'] : NULL;
		$resultado = array();

		$filter['limite'] = isSet($_GET['l']) ? $_GET['l'] : 100;

		if ($filter)
		{
			$resultado = $empresa->busca($filter);
			$filter['limite'] += 100;
		}		

		return array('resultado' => $resultado, 'busca' => $filter, 'estados' => $estados, 'orgaos' => $orgaos, 'motivos' => $motivos, 'ranking' => $ranking);
	}
}
?>