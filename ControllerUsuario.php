<?php
	require_once 'Usuario.php';
	require_once 'DaoUsuario.php';

	$cusuario = new ControllerUsuario();
	
	
	class ControllerUsuario{
		function __construct(){
			
			//isset testa se o atributo � diferente de null
			if(isset($_POST['acao'])){
				$acao = $_POST['acao'];
				
			}else{
				$acao = $_GET['acao'];
			}
			
			if (isset($acao)){
				$this-> processarAcao($acao);
			}else{
				echo "<div class='retorno'>Nenhuma ação a ser processada</div>";
			}
		}
		
		public function processarAcao($acao){
			
			if($acao == "cadastrar"){
				$this->cadastrar();
			}else if($acao == "consultar"){
				$this->consultar();
			}else if ($acao == "excluir"){
				$this->excluir();		
			}else if($acao == "editar"){
				$this->editar();
			}else if ($acao == "atualizar"){
				$this->atualizar();
			}
		}
		
		public function cadastrar(){
			$usu = new Usuario();

			// comando para encriptar a senha
			$senhaEncriptada = sha1($_POST["senha"]);
			$usu->setSenha($senhaEncriptada);
			
            $usu->setEmail($_POST["email"]);
            $usu->setNome($_POST["nome"]);			
			$daoUsu = new DaoUsuario();
            $idUsuario = $daoUsu->inserir($usu); // idUsuario é o last insert id que retornou do DAO
            
            if($idUsuario == true){
                echo "<div class='retorno clear'>
                        <h1 class='mensagem-principal'>Obrigado por realizar o cadastro!</h1>
                    </div>";
            }else{
                echo "<div class='retorno clear'>
                        <h1 class='mensagem-principal'>Erro ao cadastrar!</h1>
                        <h1 class='mensagem-secundaria'>Tente novamente em instantes!</h1>
                    </div>";
            }
			
		}
		
		public function consultar(){						
			$daoUsu = new DaoUsuario();
			$usu = new Usuario();
			
			if(isset($_POST["email"])){
				$usu->setEmail($_POST["email"]);
			}
            $vetCliente = $daoUsu->consultar($usu->getEmail());
            
            session_start();
            $_SESSION['usuarioLogado'] = $vetCliente;
            session_write_close();
            
            header('Location: index.php');
		}	
		
		public function sair(){
			session_start();
			$_SESSION['usuarioLogado'] = null;
			session_destroy();
			//echo "sess&atilde;o encerrada";
			header('Location: index.php');
		}
	}

?>

