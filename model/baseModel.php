<?php 

class baseModel{
	protected   $dbname,
				$user,
				$pass,
				$connection;

	protected function __construct()
	{
		$this->dbname = "heroku_3acb595e064fe48";
		$this->user = "bd5233fd978702";
		$this->pass = "57345e20";
		$this->connection = self::connectDB($this->dbname,$this->user,$this->pass);
	}

	private function connectDB($nome, $usuario, $senha)
	{
		try
		{
			$connection = new PDO('mysql:host=us-cdbr-east-04.cleardb.com;dbname='.$nome,$usuario,$senha,array(PDO::ATTR_PERSISTENT => true));
        }
        catch (PDOException $e)
        {
            die("Erro!: " . $e->getMessage() . "<br/>");
            return false;
        }
        return $connection;
	}

    // function transformDate($date,$destination) // Transforma a data do formato do banco para o formato do view e vice-versa
    // {
    //     if ($destination == 'db')
    //     {
    //         $newDate = str_replace('/', '-', $date);
    //         return date('Y-m-d', strtotime($newDate));
    //     }
    //     else if ($destination == 'view')
    //         return str_replace('-','/',date("d-m-Y", strtotime($date)));
    // }
}
?>