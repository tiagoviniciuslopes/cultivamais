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
        <!--<script type="text/javascript" src="../_js/idioma.js"></script>-->
<div class="jumbotron col-md-8 col-md-offset-2 col-sm-12" style="background: rgba(255,255,255,.5)">
<!--Tipos de Usuario-->
<form class="form-horizontal" role="form" id="formularioCadastro" action='ControllerUsuario.php' method="POST">
  <legend>Cadastre-se</legend>
  <div class="col-md-offset-1 col-md-10">
  
  <!--Cadastro Geral-->
  <div class="usuario">
    <div class="form-group">
      <label for="nome" class="col-md-3 col-sm-3 control-label">Nome</label>
      <div class="col-md-9 col-sm-9">
        <input type="text" class="form-control required"  placeholder="Nome" name="nome" id="nome">
      </div>
    </div>

    <div class="form-group">
      <label for="email" class="col-md-3 col-sm-3 control-label">Email</label>
      <div class="col-md-9 col-sm-9">
        <input type="text" class="form-control email required" name="email" id="email" placeholder="Email">
      </div>
    </div>

    <div class="form-group">
      <label for="senha" class="col-md-3 col-sm-3 control-label">Senha</label>
      <div class="col-md-9 col-sm-9">
        <input type="password" class="form-control required" id="senha" name="senha" placeholder="Senha">
      </div>
    </div>
  </div>

  
  <div class="form-group">
    <div class="col-md-1 col-md-offset-2">
      <input type="submit" class="btn btn-default" value="Cadastrar" id="cadastrarUsuario">
      <input type="hidden" name="acao" value="cadastrar"/>
    </div>
  </div>
  </div>
</form>
</div>

    </body>
</html>