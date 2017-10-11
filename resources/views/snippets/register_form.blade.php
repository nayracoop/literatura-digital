<div class="modal fade" id="registrarse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">      
        <div class="loginmodal-container">
        <h1>Registrarse</h1>
          <form method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}
              <input type="text" name="first_name" placeholder="Nombre">
              <input type="text" name="last_name" placeholder="Apellido">
              <input type="text" name="username" placeholder="Nombre de usuario">
              <input type="text" name="email" placeholder="Tu email">
              <input type="password" name="password" placeholder="Tu contraseña">
               <input type="password" name="password_confirmation" placeholder="Confirma tu contraseña">
              <input type="submit" name="login" class="login loginmodal-submit" value="Comenzá a escribir">
          </form>
        <div class="login-help">
            <p>¿Ya eres miembro? <a href="http://bardo.surwww.com/home.html#">Ingresá</a></p>
        </div>
        </div>
    </div>
  </div>