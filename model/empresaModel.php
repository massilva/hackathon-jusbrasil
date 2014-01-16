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
}
?>