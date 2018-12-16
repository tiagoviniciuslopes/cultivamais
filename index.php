<html>
	<head>

	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	    <title>Cultiva+ KML Drawer</title>
	    <link href="js/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

		<link href='https://fonts.googleapis.com/css?family=ABeeZee' rel='stylesheet'>
		<script src="https://maps.google.com/maps/api/js?key=AIzaSyC8-RhkdZpUSUL7k-rscOWE6PZB4IQi2rI&callback=initMap&libraries=drawing,places"></script>
		<script src="script2.js"></script>
		
	    <script src="js/jquery.min.js"></script>
	    <script src="js/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
		
		<style>
			#all{
				width: 100%;
				height: 100%;
				
			}
			iframe{
				width: 100%;
				height: 100%;
			}
			#header{
				width: 100%;
				height: 25%;
				background-color: #52BE80;
				border-bottom-style: solid;
				border-bottom-color: white;
				border-bottom-width: 2px;
				border-radius: 10px;

			}
			#logo{
				text-align:center;
				float: left;
				width:40%;
				height:100%;
			}
			#login{
				float: right;
				padding: 10px;
				height:100%;
				width: 26%;
			}
			input{
				margin-bottom:30px;
				border-radius: 30px;
				font-family: 'ABeeZee';
			}
			#body{
				width: 100%;
				height: 80%;
				border-radius: 10px;
				background-color: #52BE80;
			}
			#map{
				position: relative;
				height:95%;
				width:62%;
				float: right;
				top: 1%;
				right: 3%;
			}
			#instructions{
				font-size:32px;
				text-shadow: 0.5px 0.5px 0.5px white;
				color:white;
				float:left;
				width:30%;
				height:95%;
				padding-top:3%;
				padding-left: 3%;
				font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif;

			}
			ol{
				list-style-type: decimal;
			}
			.button{
				border-radius: 30px;
				background-color: white;
				padding: 5%;
				font-size: 25px;
				border-width: 0;
				color:#145A32;
			}
			label{
				font-family: 'ABeeZee';
				font-size: 25px;
				color:#145A32;
			}
			#login-form{
				float: left;
			}
			.bemVindo{
				width:100%;
			}
			.left{
				align: left;
			}
			h1{
				text-align: center;
			}
			
		</style>
	</head>

	<body>
		
		<div id='all'>
			<div id='header'>
				<div id='logo'>
					<img src='logo.png'>
				</div>
				
				<?php
					require_once "Usuario.php";

					session_start();
					$user = null;
					if($_SESSION['usuarioLogado']->getEmail()==null ){
						echo"<div id='login'>
							<form id='login-form' class='form-horizontal' role='form' action='ControllerUsuario.php' method='POST'>
								<label for='email' class='col-md-3 col-sm-3 control-label'>Email</label>
								<div class='col-md-9 col-sm-9'>
									<input type='text' class='form-control email required' name='email' id='email' placeholder='Email'>
								</div>
								<div class='form-group'>
									<label for='senha' class='col-md-3 col-sm-3 control-label'>Senha</label>
									<div class='col-md-9 col-sm-9'>
									<input type='password' class='form-control required' id='senha' name='senha' placeholder='Senha'>
									</div>
								</div>
								<div class='col-md-offset-2 col-md-5'>
									<button type='submit' class='btn btn-default'>Logar</button>
									<a href='cadastro.php' class='btn btn-default'>Cadastre-se</a>
									<input type='hidden' name='acao' value='consultar'>
								</div>
							</form>
						</div>";
					}else{
						//session_start();
						$user = $_SESSION["usuarioLogado"];
						echo"<div id='login' class='col-md-9 col-sm-9'><form id='login-form' class='form-horizontal' role='form' action='ControllerUsuario.php' method='POST'>
								<div class='col-md-9 col-sm-9 row bemVindo'><label for='email' class='col-md-3 col-sm-3 control-label bemVindo'>Bem vindo " . $user->getNome() . "</label></div>
								<input type='hidden' name='acao' value='consultar'>
								<div class='col-md-offset-2 col-md-5 left'><button type='submit' class='btn btn-default left'>Sair</button></div>
								</form></div>";
					}
				?>

			</div>
			
			<div id='body'>
				<div id='instructions'>
					<h1>PASSOS</h1>
					<ol id='steps'>
						<li>Procure seu talhao no mapa</li>
						<li>Selecione o talhao clicando <br>com o mouse ao redor dele</li>
						<li>Certifique-se de que os pontos<br> se conectam no fim</li>
						<li>Clique na aba KML</li>
						<li>Clique em download</li>
						<li>Envie o KML baixado para o <br>email orcamentos@cultivamais.com.br</li>
					</ol>
				</div>
				<div id='map'>
					<iframe src="https://www.doogal.co.uk/polylines.php#tabs" scrolling="no" frameBorder="0">
					</iframe>
				</div>
			</div>
			
		</div>
	</body>
</html>
