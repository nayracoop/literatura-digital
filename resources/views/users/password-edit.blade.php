@extends('layouts.main')

@section('title')
@lang('Mi perfil')
@endsection

@section('content')
<div class="fondo-forms">
    <div class="container formulario form-detalle">
        <div class="row">
            <div class="col-lg-12">
                <div class="data-relato">
                    <div class="image-clip">
                        @if ($user->avatar != null && !empty($user->avatar))
                        <img alt="@lang('messages.avatar_of') {{$user->getName()}}" src="{{ url('imagenes/avatar/' . $user->avatar )}}">
                        @else
                        <img src="{{asset('img/img-usuario.jpg')}}" alt="" />
                        @endif
                    </div>
                    <p class="tit-relato">{{ $user->username }}</p>
                    <p class="autor-relato">{{ $user->getName() }}</p>
                </div>
            </div>

            @php
                $current_user = auth()->user();
                $userAdmin = $current_user->role == \App\Models\Enums\UserType::ADMIN;
            @endphp
            <form role="form" method="post" action="{{ route('user.password.update') }}" id="edit-user-password">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="col-md-8">
                    <div class="form-padding-interno">
                        <label for="password">@lang('messages.password') *</label>
                        <input type="password" class="form-control" id="password" value="" name="password">
                        <label for="password_confirmation">@lang('messages.confirm_password') *</label>
                        <input type="password" class="form-control" id="password_confirmation" value="" name="password_confirmation">

                    </div>

                </div>


                <div class="col-md-8">
                    <div class="container-botones">
                        <div class="botones-save-form">
                            <button class="btn btn-cancelar">Cancelar</button>
                            <button type="submit" class="btn btn-guardar">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('javascript')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\EditPassword', '#edit-user-password'); !!}

@endpush
