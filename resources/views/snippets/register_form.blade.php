  <div class="modal fade" id="registrarse" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-login">
      <div class="loginmodal-container">
        <h2 id="modalLabel">@lang('Registrate')</h2>
        <hr />
        <form method="POST" action="{{ route('register') }}">
         {{ csrf_field() }}
          <label for="email">Email <span>@lang('(chequeá que sea correcto)')</span></label>
          <input type="text" name="email" class="email">
          <label for="user">@lang('Elegí un nombre de usuario')</label>
          <input type="text" name="username">
          <label for="pass">@lang('Elegí una contraseña')</label>
          <input type="password" name="password">

          <input type="submit" name="login" class="login loginmodal-submit" value="Empezá a escribir">
        </form>
        <div class="login-help">
          <p>@lang('¿Ya sos miembro?') <a href="#">@lang('Ingresá')</a></a></p>
        </div>
      </div>
    </div>
  </div>
