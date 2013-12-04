<?php

include_once 'baseModel.php';

class empresaModel extends baseModel {

    public $id, 
           $name;

    public function __construct()
    {
         parent::__construct();
         $this->id = -1; 
         $this->name = '';
    }

    function getTresMaiores($pdo){
        $pessoa = array();
        try{
           if($pdo){
                // Com o objeto PDO instanciado
                // preparo uma query a ser executada
                $stmt = $pdo->prepare("SELECT nome, COUNT(*) as qtd, uf_pessoa, cnpj_cpf FROM `ceis` GROUP BY cnpj_cpf ORDER BY qtd desc LIMIT 3");

                // Executa query
                $stmt->execute();

                // lembra do mysql_fetch_array?
                //PDO:: FETCH_OBJ: retorna um objeto anônimo com nomes de propriedades que
                //correspondem aos nomes das colunas retornadas no seu conjunto de resultados
                //Ou seja o objeto "anônimo" possui os atributos resultantes de sua query
                while($obj = $stmt->fetch(PDO::FETCH_OBJ)){
                    $pessoa[] = $obj;
                }
           }        
        } catch(PDOException $e){
            echo $e->getMessage();
        }   
        return $pessoa;
    }

    function getDetalheMotivo($pdo){
        $pessoas = getTresMaiores($pdo);
        $motivos = array();
        try{
           if($pdo){
                foreach ($pessoas as $key => $obj){
                    // Com o objeto PDO instanciado
                    // preparo uma query a ser executada
                    $stmt = $pdo->prepare("SELECT COUNT(tipo_sancao) as qtd, tipo_sancao, nome, uf_pessoa, cnpj_cpf FROM ceis WHERE cnpj_cpf = :cnpj GROUP BY tipo_sancao ORDER BY qtd DESC");
                    $stmt->bindParam(":cnpj", $obj->cnpj_cpf, PDO::PARAM_STR);

                    // Executa query
                    $stmt->execute();

                    // lembra do mysql_fetch_array?
                    //PDO:: FETCH_OBJ: retorna um objeto anônimo com nomes de propriedades que
                    //correspondem aos nomes das colunas retornadas no seu conjunto de resultados
                    //Ou seja o objeto "anônimo" possui os atributos resultantes de sua query
                    while($objt = $stmt->fetch(PDO::FETCH_OBJ )){
                        $motivos[] = $objt;
                    }
                    
                }
           }        
        } catch(PDOException $e){
            echo $e->getMessage();
        }   
        return $motivos;
    }

    function getMotivo($pdo){
        $sancao = array();
        try{
           if($pdo){
                // Com o objeto PDO instanciado
                // preparo uma query a ser executada
                $stmt = $pdo->prepare("SELECT COUNT(*) as qtd, tipo_sancao FROM ceis GROUP BY tipo_sancao ORDER BY qtd DESC");
                
                // Executa query
                $stmt->execute();

                // lembra do mysql_fetch_array?
                //PDO:: FETCH_OBJ: retorna um objeto anônimo com nomes de propriedades que
                //correspondem aos nomes das colunas retornadas no seu conjunto de resultados
                //Ou seja o objeto "anônimo" possui os atributos resultantes de sua query
                while($obj = $stmt->fetch(PDO::FETCH_OBJ )){         
                    $sancao[] = $obj;
                }
           }        
        } catch(PDOException $e){
            echo $e->getMessage();
        }   
        return $sancao;
    }

    function getInidonioByEstado($pdo){
        $top = array();
        try{
           if($pdo){
                // Com o objeto PDO instanciado
                // preparo uma query a ser executada
                $stmt = $pdo->prepare("SELECT COUNT(*) as qtd, uf_pessoa FROM `ceis` WHERE uf_pessoa <> '--' GROUP BY uf_pessoa ORDER BY qtd DESC");
                
                // Executa query
                $stmt->execute();

                // lembra do mysql_fetch_array?
                //PDO:: FETCH_OBJ: retorna um objeto anônimo com nomes de propriedades que
                //correspondem aos nomes das colunas retornadas no seu conjunto de resultados
                //Ou seja o objeto "anônimo" possui os atributos resultantes de sua query
                while($obj = $stmt->fetch(PDO::FETCH_OBJ )){         
                    $top[] = $obj;
                }
           }        
        } catch(PDOException $e){
            echo $e->getMessage();
        }   
        return $top;
    }

    function getTopInidonio($pdo){
        $ranking = array();
        try {
           if($pdo){
                // Com o objeto PDO instanciado
                // preparo uma query a ser executada
                $stmt = $pdo->prepare("SELECT nome, COUNT(*) as qtd, uf_pessoa FROM `ceis` GROUP BY cnpj_cpf ORDER BY qtd desc LIMIT 3");
                
                // Executa query
                $stmt->execute();

                // lembra do mysql_fetch_array?
                //PDO:: FETCH_OBJ: retorna um objeto anônimo com nomes de propriedades que
                //correspondem aos nomes das colunas retornadas no seu conjunto de resultados
                //Ou seja o objeto "anônimo" possui os atributos resultantes de sua query
                while($obj = $stmt->fetch(PDO::FETCH_OBJ )){         
                    $ranking[] = $obj;
                }
           }       
        // tratamento da exeção
        } catch ( PDOException $e ) {
            echo $e->getMessage();
        }    
        return $ranking;
    }

    function getTipoSancao($pdo){        
        if(!$pdo){
            die('Erro ao criar a conexão!');
        }
        else{
            $stmt = $pdo->prepare("SELECT DISTINCT tipo_sancao FROM ceis order by tipo_sancao");
            $stmt->execute();

            while($obj = $stmt->fetch(PDO::FETCH_OBJ )){         
                $tipo_sancao[] = $obj;
            }
        }
        return $tipo_sancao;
    }

    function getOrgao($pdo){
        if(!$pdo){
           die('Erro ao criar a conexão!');
        }
        else{
            $stmt = $pdo->prepare("SELECT DISTINCT orgao FROM ceis order by orgao");
            $stmt->execute();

            while($obj = $stmt->fetch(PDO::FETCH_OBJ )){         
                $orgao[] = $obj;
            }
        }
        return $orgao;
    }

    function buscaProfundidade($needle, $array, $nivel = 0){
        foreach ($array as $key => $value)
        { 
            if(is_array($value)){
                $buscado = buscaProfundidade($needle,$value,$nivel++);
            }
            if($value == $needle){
                return array("nivel" => $nivel, "key"=>$key);
            }
            if(is_array($buscado)){
                return $buscado;
            }
        }
        return -1;
    }

$tipo_sancao = array();
$orgao = array();

$ranking = getTopInidonio($pdo);
$byEstado = getInidonioByEstado($pdo);
$tipo_sancao= getTipoSancao($pdo);
$orgao= getOrgao($pdo);
$tipoSancao = getMotivo($pdo);
$motivos = getDetalheMotivo($pdo);

$estados = array();
foreach ($byEstado as $key => $obj){
    $estados[$key][] = "BR-".$obj->uf_pessoa;
    $estados[$key][] = $obj->qtd;
}

foreach ($tipoSancao as $key => $obj){
    $motivo[$key]['label'] = utf8_encode($obj->tipo_sancao);
    $motivo[$key]['value'] = $obj->qtd;
}

if(isSet($_GET['busca'])){
    $busca = $_GET['busca'];
    $nome = isSet($busca['nome']) ? $busca['nome'] : "";
    $cnpj = isSet($busca['cnpj']) ? $busca['cnpj'] : "";
    $uf = isSet($busca['uf']) ? $busca['uf'] : "";
    $orgao_busca = isSet($busca['orgao']) ? $busca['orgao'] : "";
    $processo = isSet($busca['processo']) ? $busca['processo'] : "";
    $sancao = isSet($busca['tipo_sancao']) ? $busca['tipo_sancao'] : "";
    
    $resultado = array();
    $limite = isSet($_GET['l']) ? $_GET['l'] : 100;
    
    try {

        // Com o objeto PDO instanciado
        // preparo uma query a ser executada
        if(empty($nome) && empty($cnpj) && $uf == "UF" && $orgao_busca == "ORGAO" && $sancao == "MOTIVO" && empty($processo)){
            $stmt = $pdo->prepare("SELECT * FROM ceis LIMIT ".$limite);
        }
        else{
            $consulta = "SELECT * FROM ceis WHERE";

            if(!empty($nome)){
                $consulta .= " nome like :nome";
                $nome = "%".$nome."%"; 
            }

            if(!empty($cnpj)){
                if(!empty($nome)){
                    $consulta .= " AND";
                }
                $consulta .= " cnpj_cpf = :cnpj";
            }

            if(!empty($processo)){
                if(!empty($nome) OR !empty($cnpj)){
                    $consulta .= " AND";
                }   
                $consulta .= " num_processo = :num_processo";
            }
            
            $complemento = (!empty($nome) OR !empty($cnpj)) OR !empty($processo);

            if(!empty($uf) AND $uf != "UF"){
                if($complemento){
                    $consulta .= " AND";
                }
                $consulta .= " uf_pessoa like :uf_pessoa";
                $complemento = true;
            }
            
            if(!empty($orgao_busca) AND $orgao_busca != "ORGAO"){
                if($complemento){
                    $consulta .= " AND";
                }
                $consulta .= " orgao like :orgao_busca";
                $complemento = true;
            }

            if(!empty($sancao) AND $sancao != "MOTIVO"){
                if($complemento){
                    $consulta .= " AND";
                }
                $consulta .= " tipo_sancao like :tipo_sancao ";
                $complemento = true;
            }

            $consulta .= " LIMIT ".$limite;
            $stmt = $pdo->prepare($consulta);

            if(!empty($nome)){
                $stmt->bindParam(":nome", utf8_decode($nome) , PDO::PARAM_STR);
            }

            if(!empty($cnpj)){
                $stmt->bindParam(":cnpj", $cnpj , PDO::PARAM_STR);
            }

            if(!empty($processo)){
                $stmt->bindParam(":num_processo", utf8_decode($processo), PDO::PARAM_STR);
            }

            if(!empty($uf) AND $uf != "UF"){
                $stmt->bindParam(":uf_pessoa", $uf , PDO::PARAM_STR);
            }
            
            if(!empty($orgao_busca) AND $orgao_busca != "ORGAO"){
                $stmt->bindParam(":orgao_busca", utf8_decode($orgao_busca), PDO::PARAM_STR);
            }
            
            if(!empty($sancao) AND $sancao != "MOTIVO"){
                $stmt->bindParam(":tipo_sancao", utf8_decode($sancao), PDO::PARAM_STR);
            }
            
        }
        // Executa query
        $stmt->execute();
        // lembra do mysql_fetch_array?
        //PDO:: FETCH_OBJ: retorna um objeto anônimo com nomes de propriedades que
        //correspondem aos nomes das colunas retornadas no seu conjunto de resultados
        //Ou seja o objeto "anônimo" possui os atributos resultantes de sua query
        while($obj = $stmt->fetch(PDO::FETCH_OBJ )){         
            $resultado[] = $obj;
        } 
        $pdo = null;
    // tratamento da exeção
    } catch ( PDOException $e ) {
        echo $e->getMessage();
    }
    
}
?>