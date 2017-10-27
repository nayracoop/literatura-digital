  <div class="modal fade" id="registrarse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="loginmodal-container">
        <h1>@lang('Registrarse')</h1>
        <form method="POST" action="{{ route('register') }}">
          {{ csrf_field() }}
          <label for="email"><strong>@lang('Email')</strong> (@lang('chequeá que sea correcto'))</label>
          <input type="text" name="email" class="email">

          <label for="user">@lang('Elije un') <strong>@lang('nombre de usuario')</strong></label>
          <input type="text" name="username">
          <label for="pass">@lang('Elije una') <strong>@lang('contraseña')</strong></label>
          <input type="password" name="password">
          <label for="pass">@lang('Repite tu ') <strong>@lang('contraseña')</strong></label>
          <input type="password" name="password_confirmation">
          <input type="submit" name="login" class="login loginmodal-submit" value="@lang('Empezá a escribir')">
        </form>
        <div class="login-help">
          <p>@lang('¿Ya sos miembro?')<a data-toggle="modal" href="#ingresar">@lang('Ingresá')</a></a></p>
        </div>
      </div>
    </div>
  </div>