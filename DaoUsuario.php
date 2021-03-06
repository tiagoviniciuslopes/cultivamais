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
		
		public function inserir($usuario ){
            $this->conectar();
            
            try{
                $stmt = $this->conexao->prepare("INSERT INTO usuario (emailUsuario, senhaUsuario, nomeUsuario, cpfUsuario, telefoneUsuario) VALUES (?, ?, ?, ?, ?)");
                $stmt->bindValue(1, $usuario->getEmail());
                $stmt->bindValue(2, $usuario->getSenha());
				$stmt->bindValue(3, $usuario->getNome());
				$stmt->bindValue(4, $usuario->getCpf());
				$stmt->bindValue(5, $usuario->getTelefone());

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
					$usuario->setCpf($row["cpfUsuario"]);
					$usuario->setTelefone($row["telefoneUsuario"]);
                    $usuario->setNome($row["nomeUsuario"]);
                    $usuario->setIdUsuario($row["idUsuario"]);
				}

				$this->desconectar();
				return $usuario;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}

		public function consultarNome($nome){
			$this->conectar();

			$vetUsu = null;
			try{
				$query = "SELECT * FROM usuario where nomeUsuario LIKE ?";
				$stmt = $this->conexao->prepare($query);
				$stmt->bindValue(1, '%'.$nome.'%');
				$stmt->execute();

				foreach ($stmt as $row){
					$usuario = new Usuario();
					$usuario->setEmail($row["emailUsuario"]);
					$usuario->setSenha($row["senhaUsuario"]);
					$usuario->setCpf($row["cpfUsuario"]);
					$usuario->setTelefone($row["telefoneUsuario"]);
                    $usuario->setNome($row["nomeUsuario"]);
					$usuario->setIdUsuario($row["idUsuario"]);
					
					$vetUsu[] = $usuario;
				}

				$this->desconectar();
				return $vetUsu;
			}catch (PDOException $ex){
				echo "Erro: ".$ex->getMessage();
			}
		}
	}
?>
