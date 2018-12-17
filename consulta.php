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

    </head>

    <body>
        <?php
            require_once "Usuario.php";
            session_start();

            if(!isset($_SESSION['usuarioLogado']) || $_SESSION['usuarioLogado']->getNome()==null){
                echo "<h1>Você não possui permissão para acessar esta pagina.</h1>";
            }else{
                echo"<div id='login' class='col-md-9 col-sm-9'><form id='login-form' class='form-horizontal' role='form' action='ControllerUsuario.php' method='POST'>
								<div class='col-md-9 col-sm-9 row bemVindo'><label for='email' class='col-md-3 col-sm-3 control-label bemVindo'>Bem vindo</label></div>
								<input type='hidden' name='acao' value='sair'>
								<div class='col-md-offset-2 col-md-5 left'><button type='submit' class='btn btn-default left'>Sair</button></div>
								</form></div>";
                echo '<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-2 col-xs-12">
                        <form class="form-horizontal" role="form" action="ControllerUsuario.php" method="POST">
                            <legend>Consulte clientes por nome</legend>
                            <div class="form-group">
                                <label for="nome" class="col-md-2 col-sm-2 control-label">Nome</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
                                </div>
                            </div>
                            <div class="form-group clear">
                                <div class="col-md-offset-2 col-md-5">
                                    <button type="reset" class="btn btn-default">Limpar</button>
                                    <button type="submit" class="btn btn-default">Buscar</button>
                                    <input type="hidden" name="acao" value="consultar">
                                </div>
                            </div>
                        </form>
                    </div>
            ';
            }
        ?>
    </body>

</html>

