<!DOCTYPE html>
<!-- saved from url=(0044)http://bardo.surwww.com/relato-escribir.html -->
<html lang="es"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Escrituras digitales &gt; Leñador de Mike Wilson</title>

  <link href="./relato-escribir_files/bootstrap.min.css" rel="stylesheet">
  <link href="./relato-escribir_files/escrituras.css" rel="stylesheet">

</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-escrituras-collapse">
          <span class="sr-only">Desplegar navegación</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="http://bardo.surwww.com/relato-escribir.html#">Escrituras digitales</a>
      </div>
      <div class="collapse navbar-collapse navbar-escrituras-collapse">
        <ul class="nav navbar-nav">
          <li><a href="http://bardo.surwww.com/relato-escribir.html#about">Sobre Escrituras digitales</a></li>
          <li><a href="http://bardo.surwww.com/relato-escribir.html#services">Relatos</a></li>
          <li><a href="http://bardo.surwww.com/relato-escribir.html#contact">Contacto</a></li>
        </ul>
        <ul class="nav navbar-nav pull-right">
          <li><a data-toggle="modal" href="http://bardo.surwww.com/relato-escribir.html#ingresar">Ingresar</a></li>
          <li><a data-toggle="modal" href="http://bardo.surwww.com/relato-escribir.html#registrarse">Registrarse</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="modal fade" id="ingresar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
    <div class="loginmodal-container">
        <h1>Ingresar</h1>
      <form>
      <input type="text" name="user" placeholder="Tu mail">
      <input type="password" name="pass" placeholder="Tu contraseña">
      <input type="submit" name="login" class="login loginmodal-submit" value="Ingresar">
      </form>
    <div class="login-help">
      <a data-toggle="modal" href="http://bardo.surwww.com/relato-escribir.html#registrarse">Registrarse</a> - <a href="http://bardo.surwww.com/relato-escribir.html#">Olvidaste tu contraseña?</a>
    </div>
    </div>
  </div>
  </div>

  <div class="modal fade" id="registrarse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
    <div class="loginmodal-container">
      <h1>Registrarse</h1>
      <form>
        <input type="text" name="user" placeholder="Nombre de usuario">
        <input type="text" name="user" placeholder="Tu email">
        <input type="password" name="pass" placeholder="Tu contraseña">
        <input type="submit" name="login" class="login loginmodal-submit" value="Comenzá a escribir">
      </form>
    <div class="login-help">
      <p>¿Ya eres miembro? <a href="http://bardo.surwww.com/relato-escribir.html#">Ingresá</a></p>
    </div>
    </div>
  </div>
  </div>

  <div class="container">

    <div class="row">
      <div class="col-lg-8 col-lg-offset-2">

      <form class="form-horizontal" role="form" method="post" action="{{ route('story.store') }}">
        {{ csrf_field() }}
        <div class="form-group">
          <label class="control-label">Título</label>
          <input name="title" type="text" class="form-control" placeholder="Fragmento 1 Sin Título">
        </div>
        <div class="form-group">
          <label for="inputPassword" class="control-label">Editor de texto</label>
          <textarea name="description" class="form-control" rows="20"></textarea>
        </div>
        <button type="submit" class="btn btn-default">Publicar</button>
      </form>
      
      <button type="submit" class="btn btn-default">Publicar</button>
      <button class="btn btn-default">Guardar</button>
      <button class="btn btn-default">Vista previa</button>

      </div>

      </div>
  </div>

  <script src="./relato-escribir_files/jquery.min.js.descarga"></script>
  <script src="./relato-escribir_files/bootstrap.min.js.descarga"></script>

</body></html>