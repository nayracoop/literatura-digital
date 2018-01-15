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
                <input id="login-button" type="submit" name="login" class="login loginmodal-submit" value="Ingresá">
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

@push('javascript')
<script>

// Login via Ajax
$('#login-button').on("click", function(e) {
    
});

function loginUser() {
    var formElement = document.getElementById("ingresar");
    var formData = new FormData( formElement );
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
        //  document.getElementById("demo").innerHTML = this.responseText;
        // console.log(xhttp.statusText);
        newResponse = JSON.parse( xhttp.response);
        console.log(newResponse);
        // console.log('logueado');
        } else {
        console.log(xhttp.statusText);
        // console.log('ERROR');
        }
    };
    xhttp.open("POST", "{{route('login')}}", true);
    xhttp.setRequestHeader('X-CSRF-Token', "{{csrf_token()}}" );
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(formData);
}
</script>
@endpush
