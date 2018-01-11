<div class="modal fade" id="ingresar" tabindex="-1" role="dialog" 
    aria-labelledby="modalLabel2" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-login">
        <div class="loginmodal-container">
            <h2 id="modalLabel2">@lang('Ingresá')</h2>
            <hr />
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <label for="email">@lang('Email')</label>
                <input type="text" name="email" class="email">
                <label for="pass">@lang('Contraseña')</label>
                <input type="password" name="password">
                <input type="submit" name="login" class="login loginmodal-submit" value="Ingresá">
                <p class="recovery">
                    <a href="#">@lang('¿Olvidaste tu contraseña?')</a>                    
                </p>
            </form>
            <div class="login-help">
                <p>@lang('¿Todavía no sos miembro?')
                    <a href="#"> @lang('Registrate')</a>
                </p>
            </div>
        </div>
    </div>
</div>