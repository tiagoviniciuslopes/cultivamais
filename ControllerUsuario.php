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
			}else if($acao == "logar"){
				$this->logar();
			}else if($acao == "sair"){
				$this->sair();
			}
		}
		
		public function cadastrar(){
			$usu = new Usuario();

			// comando para encriptar a senha
			$senhaEncriptada = sha1($_POST["senha"]);
			$usu->setSenha($senhaEncriptada);
			
            $usu->setEmail($_POST["email"]);
			$usu->setNome($_POST["nome"]);		
			$usu->setCpf($_POST["CPF"]);	
			$usu->setTelefone($_POST["telefone"]);	

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
		
		public function logar(){						
			$daoUsu = new DaoUsuario();
			$usu = new Usuario();
			session_start();

			$senhaEncriptada = null;
			if(isset($_POST["email"])){
				$usu->setEmail($_POST["email"]);
			}
			if(isset($_POST["senha"])){
				$senhaEncriptada = sha1($_POST["senha"]);
			}
			$usu->setSenha($senhaEncriptada);

			$vetCliente = $daoUsu->consultar($usu->getEmail());
            
			if($vetCliente->getSenha() == $usu->getSenha()){
				$_SESSION['usuarioLogado'] = $vetCliente;
				session_write_close();
			}else{
				$_SESSION['usuarioLogado'] = null;
				session_destroy();
			}
			
            header('Location: index.php');
		}	

		public function consultar(){						
			$daoUsu = new DaoUsuario();
			$usu = new Usuario();

			if(isset($_POST["nome"])){
				$usu->setNome($_POST["nome"]);
			}
            $vetUsu = $daoUsu->consultarNome($usu->getNome());
            
            echo '<html>
			<head>
		
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
				<title>Cultiva+ KML Drawer</title>
				<link href="js/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
		
				<link href="https://fonts.googleapis.com/css?family=ABeeZee" rel="stylesheet">
				<script src="https://maps.google.com/maps/api/js?key=AIzaSyC8-RhkdZpUSUL7k-rscOWE6PZB4IQi2rI&callback=initMap&libraries=drawing,places"></script>
				<script src="script2.js"></script>
				
				<script src="js/jquery.min.js"></script>
				<script src="js/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
			</head>
			<body>';
            echo '<section class="conteudo col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">';
	
			echo '<div class="col-md-10 col-md-offset-1" style="padding:.5em">

					<div class="panel panel-default">
						<div class="panel-heading">
							<h2>Consulta de Clientes </h2>
							<h5>Resultado da consulta</h5>
						</div>
				
						<div class="panel-body">
							<table class="table table-hover">
								<th>ID</th>
								<th>Nome</th>
								<th>Email</th>
								<th>CPF</th>
								<th>Telefone</th>';
				
								
								foreach($vetUsu as $item){
									echo
										"<tr>".
											"<td>". $item->getIdUsuario() . "&nbsp; </td>".
											"<td>
												".
											$item->getNome(). "&nbsp;
											</td>".
											"<td>"
												.$item->getEmail() . "&nbsp;
											</td>".
											"<td>".
												$item->getCpf() . "&nbsp;
											</td>".
											"<td>".
												$item->getTelefone() . "&nbsp;
											</td>".
										"</tr>";
								}
		
					
		
						echo'</table>
						</div>
					</div>
				</div>';

			echo '</section></body></html>';
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

