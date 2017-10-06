<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-escrituras-collapse">
          <span class="sr-only">Desplegar navegación</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('index') }}">Escrituras digitales</a>
      </div>
      <div class="collapse navbar-collapse navbar-escrituras-collapse">
        <ul class="nav navbar-nav">
          <li><a href="#about">Sobre Escrituras digitales</a></li>
          <li><a href="#services">Relatos</a></li>
        </ul>
        <ul class="nav navbar-nav pull-right">
          @if( Auth::check() )
       <li><a data-toggle="modal" href="#perfil">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</a></li>
       <li><a data-toggle="modal" href="{{ route('salir') }}">Salir</a></li>
  @else
    <li><a data-toggle="modal" href="http://bardo.surwww.com/home.html#ingresar">Ingresar</a></li>
    <li><a data-toggle="modal" href="http://bardo.surwww.com/home.html#registrarse">Registrarse</a></li>
  @endif
          
        </ul>
      </div>
    </div>
  </nav>

  <div class="modal fade" id="ingresar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">
          <h1>Ingresar </h1>
          <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

          <input type="text" name="email" placeholder="Tu mail">
            <input type="password" name="password" placeholder="Tu contraseña">
            <input type="submit" name="user-login" class="login loginmodal-submit" value="Ingresar">
          </form>
        <div class="login-help">
            <a data-toggle="modal" href="http://bardo.surwww.com/home.html#registrarse">Registrarse</a> - <a href="http://bardo.surwww.com/home.html#">Olvidaste tu contraseña?</a>
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
            <p>¿Ya eres miembro? <a href="http://bardo.surwww.com/home.html#">Ingresá</a></p>
        </div>
        </div>
    </div>
  </div>
