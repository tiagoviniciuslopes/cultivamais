<?php
	class ControllerConexao{
		private $con = null;
		private $dbType = "mysql";
		
		//parametros de conexao
		
		private $host = "localhost";
		private $user = "root";
		private $senha = "";
		private $db = "cultiva";
		
		public function pegarConexao(){
			try{
				//realiza a conexao
				//usando o padrao new PDO ("banco:host=id_do_host:dbname=nome_da_base", "usuario, ""senha");
				
				$this->con = new PDO($this->dbType. ":host=" .$this->host . ";dbname=" .$this->db, $this->user, $this->senha);
				return $this->con;
				
			}catch (PDOException $ex){
				echo "Erro:" .$ex->getMessage();
			}
		}
	}
?>
