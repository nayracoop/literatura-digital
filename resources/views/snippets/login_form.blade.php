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
            <a data-toggle="modal" href="#registrarse">Registrarse</a> - <a href="#">Olvidaste tu contraseña?</a>
        </div>
        </div>
    </div>
</div>