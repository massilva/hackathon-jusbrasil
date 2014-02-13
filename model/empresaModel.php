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

    function getTresMaiores(){
        $pessoa = array();
        try{
           if( $this->connection ){
                // Com o objeto PDO instanciado
                // preparo uma query a ser executada
                $stmt = $this->connection->prepare("SELECT nome, COUNT(*) as qtd, uf_pessoa, cnpj_cpf FROM `ceis` GROUP BY cnpj_cpf ORDER BY qtd desc LIMIT 3");

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

    function getDetalheMotivo(){
        $pessoas = $this->getTresMaiores();
        $motivos = array();
        try{
           if($this->connection){
                foreach ($pessoas as $key => $obj){
                    // Com o objeto PDO instanciado
                    // preparo uma query a ser executada
                    $stmt = $this->connection->prepare("SELECT COUNT(tipo_sancao) as qtd, tipo_sancao, nome, uf_pessoa, cnpj_cpf FROM ceis WHERE cnpj_cpf = :cnpj GROUP BY tipo_sancao ORDER BY qtd DESC");
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

    function getMotivo(){
        $sancao = array();
        try{
           if($this->connection){
                // Com o objeto PDO instanciado
                // preparo uma query a ser executada
                $stmt = $this->connection->prepare("SELECT COUNT(*) as qtd, tipo_sancao FROM ceis GROUP BY tipo_sancao ORDER BY qtd DESC");
                
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

    function getInidonioByEstado(){
        $top = array();
        try{
           if($this->connection){
                // Com o objeto PDO instanciado
                // preparo uma query a ser executada
                $stmt = $this->connection->prepare("SELECT COUNT(*) as qtd, uf_pessoa FROM `ceis` WHERE uf_pessoa <> '--' GROUP BY uf_pessoa ORDER BY qtd DESC");
                
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

    function getTopInidonio(){
        $ranking = array();
        try {
           if($this->connection){
                // Com o objeto PDO instanciado
                // preparo uma query a ser executada
                $stmt = $this->connection->prepare("SELECT nome, COUNT(*) as qtd, uf_pessoa FROM `ceis` GROUP BY cnpj_cpf ORDER BY qtd desc LIMIT 3");
                
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

    function getTipoSancao(){        
        if(!$this->connection){
            die('Erro ao criar a conexão!');
        }
        else{
            $stmt = $this->connection->prepare("SELECT DISTINCT tipo_sancao FROM ceis order by tipo_sancao");
            $stmt->execute();

            while($obj = $stmt->fetch(PDO::FETCH_OBJ )){         
                $tipo_sancao[] = $obj;
            }
        }
        return $tipo_sancao;
    }

    function getOrgao(){
        if(!$this->connection){
           die('Erro ao criar a conexão!');
        }
        else{
            $stmt = $this->connection->prepare("SELECT DISTINCT orgao FROM ceis order by orgao");
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

    function busca($busca)
    {
        $nome = isSet($busca['nome']) ? $busca['nome'] : "";
        $cnpj = isSet($busca['cnpj']) ? $busca['cnpj'] : "";
        $uf = isSet($busca['uf']) ? $busca['uf'] : "";
        $orgao_busca = isSet($busca['orgao']) ? $busca['orgao'] : "";
        $processo = isSet($busca['processo']) ? $busca['processo'] : "";
        $sancao = isSet($busca['tipo_sancao']) ? $busca['tipo_sancao'] : "";
        
        $resultado = array();
            
        try {

            if(empty($nome) && empty($cnpj) && $uf == "UF" && $orgao_busca == "ORGAO" && $sancao == "MOTIVO" && empty($processo)){
                $stmt = $this->connection->prepare("SELECT * FROM ceis LIMIT ".$busca['limite']);
            }
            else
            {
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

                $consulta .= " LIMIT ".$busca['limite'];
                $stmt = $this->connection->prepare($consulta);

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
            
            $stmt->execute();
            while($obj = $stmt->fetch(PDO::FETCH_OBJ)){
                $obj->tipo_sancao = utf8_encode($obj->tipo_sancao); 
                $obj->data_inicio = utf8_encode($obj->data_inicio);
                $obj->data_fim = utf8_encode($obj->data_fim);
                $obj->orgao = utf8_encode($obj->orgao);
                $obj->origem_informacao = utf8_encode($obj->origem_informacao);
                $obj->data_informacao = utf8_encode($obj->data_informacao);         
                $resultado[] = $obj;      
            } 

        } catch ( PDOException $e ) {
            echo $e->getMessage();
        }

        return $resultado;
    }
}
?>