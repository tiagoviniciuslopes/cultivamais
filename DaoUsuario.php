<?php
    require_once "Usuario.php";
    require_once "ControllerConexao.php";
	
	class DaoUsuario{
		private $conexao;
		
		private function conectar(){
			$ccon = new ControllerConexao();
			$this->conexao = $ccon->pegarConexao();
		}
		
		private function desconectar(){
			$this->conexao = null;
		}
		
		public function inserir($usuario    ){
            $this->conectar();
            
            try{
                $stmt = $this->conexao->prepare("INSERT INTO usuario (emailUsuario, senhaUsuario, nomeUsuario) VALUES (?, ?, ?)");
                $stmt->bindValue(1, $usuario->getEmail());
                $stmt->bindValue(2, $usuario->getSenha());
                $stmt->bindValue(3, $usuario->getNome());

                $resultado = $stmt->execute();

                $last_insert = $this->conexao->lastInsertId();

                $this->desconectar();

                return $last_insert;
            }catch ( PDOException $ex ){
                echo "Erro: ".$ex->getMessage();
            }		
        }
        
		public function consultar($email){
			$this->conectar();

			try{
				$query = "SELECT * FROM usuario where emailUsuario = ?";
				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(1, $email);
				$stmt->execute();

				$usuario = new Usuario();
				foreach ($stmt as $row){
					$usuario->setEmail($row["emailUsuario"]);
                    $usuario->setSenha($row["senhaUsuario"]);
                    $usuario->setNome($row["nomeUsuario"]);
                    $usuario->setIdUsuario($row["idUsuario"]);
				}

				$this->desconectar();
				return $usuario;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
	}
?>
