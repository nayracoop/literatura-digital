@extends('layouts.main')

@section('title')
    @lang('Inicio')
@endsection

@section('content')

    <div class="fondo-forms">
    <div class="container formulario form-detalle">
        <div class="row">
        <div class="col-lg-12">
            <h1><span class="numero">1<span class="invisibilizar">.</span></span> Registrate en Lexia.</h1>
        </div>
            
        <form method="POST" action="{{ route('register') }}" id="register-form">
            {{ csrf_field() }}
            <div class="col-md-8">
                <div class="form-padding-interno">
                    <label for="email">Email <span class="correcto">(chequeá que sea correcto)</span></label>
                    <input type="text" class="form-control" name="email">

                    <label for="user">Elegí un nombre de usuario</label>
                    <input type="text" class="form-control" name="username">

                    <label for="pass">Elegí una contraseña</label>
                    <input type="password" class="form-control" name="password">

                    <div class="login-help registrarse-first">
                    <p>¿Ya estabas registrado en Lexia? <a data-toggle="modal" href="#ingresar">Ingresá</a></a></p>
                    </div>
                </div>
            </div>
        </form>

        <div class="botones-nav-form">
            <a href="#" onclick="document.getElementById('register-form').submit()" class="bot sig">Completá los detalles de tu relato</a>
        </div>

        </div>
        </div>
    </div>
    </div>
@endsection

@push('javascript')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\RegisterUser', '#register-form'); !!}
@endpush
