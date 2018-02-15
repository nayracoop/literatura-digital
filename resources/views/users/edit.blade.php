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
            <form role="form" method="post"
                @if ($userAdmin)
                    action="{{ route('admin.user.update', $user->_id) }}"
                @else
                    action="{{ route('user.update') }}"
                @endif
                id="edit-user-form">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                <div class="col-md-8">
                    <div class="form-padding-interno">
                        <label for="nombre">@lang('messages.user_name') *</label>
                        <input type="text" class="form-control" id="nombreusuario" value="{{ $user->username }}" name="username">
                        <label for="nombre">Nombre *</label>
                        <input type="text" class="form-control" id="nombre" value="{{ $user->first_name }}" name="first_name">
                        <label for="apellido">Apellido *</label>
                        <input type="text" class="form-control" id="apellido" value="{{ $user->last_name }}" name="last_name">
                        <label for="sobre">Sobre mí *</label>
                        <textarea class="form-control" id="sobre" name="description">{{ $user->description }}</textarea>
                        <label for="email">Email *</label>
                        <input type="text" class="form-control" id="email" value="{{ $user->email }}" name="email">
                        @if($userAdmin)
                            <label for="role">@lang('messages.role') *</label>
                            <div class="styled-select">
                                <select type="text" class="form-control" id="role" name="role">
                                    <option value="{{ App\Models\Enums\UserType::ADMIN }}"
                                        @if ($user->role == App\Models\Enums\UserType::ADMIN)
                                            selected
                                        @endif>{{ ucfirst(App\Models\Enums\UserType::ADMIN) }}
                                    </option>
                                    <option value="{{ App\Models\Enums\UserType::MOD }}"
                                        @if ($user->role == App\Models\Enums\UserType::MOD)
                                            selected
                                        @endif>{{ ucfirst(App\Models\Enums\UserType::MOD) }}
                                    </option>
                                    <option value="{{ App\Models\Enums\UserType::AUTHOR }}"
                                        @if ($user->role == App\Models\Enums\UserType::AUTHOR)
                                            selected
                                        @endif>{{ ucfirst(App\Models\Enums\UserType::AUTHOR) }}
                                    </option>
                                </select>
                            </div>
                        @endif

                        {{--  <label for="contrasena">Contraseña *</label>
                        <input type="password" class="form-control" id="contarsena">  --}}
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="portada">Imagen del usuario</label>
                    <div class="portada-border">
                        @if ($user->avatar != null && !empty($user->avatar))
                            <img alt="@lang('Avatar de') {{$user->getName()}}" src="{{ url('imagenes/cover/'.$user->avatar )}}">
                        @else
                            <img src="{{asset('img/img-usuario.jpg')}}" alt="" />
                        @endif
                    </div>
                    <input type="file" class="form-control portada-archivo" id="portada">
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
<script type="text/javascript">
    /* Upload de imagen */
    $('input[type="file"]').change(function () {
        var files = this.files;
        for (var i = 0; i < files.length; i++) {
            var formData = new FormData();
            var xhr = new XMLHttpRequest();
            formData.append('cover', files[i]);
            formData.append('_token', '{{ csrf_token() }}');
            xhr.open("POST", "{{ route( 'picture.storeXhr' ) }}");
            xhr.send(formData);
        }

        xhr.addEventListener("readystatechange", function (e) {
            var xhr = e.target;
            if (xhr.readyState == 4) {

                if (xhr.status == 200) {
                    // Acá actualizo la imagen
                    console.log(xhr.response);

                    newResponse = JSON.parse(xhr.response);
                    // console.log(JSON.parse( xhr.response).fileName  );
                    newImg = newResponse.picUrl;
                    picName = newResponse.picName;
                    // console.log(hash+'  -  '+ newImg ); //
                    $('.portada-border').find('img').remove();
                    $('.portada-border').append('<img src="' + newImg + '" />');
                    $('form').append('<input type="hidden" name="avatar" value="' + picName + '" />');
                    //$('#cover-'+hash).value(  newId);

                } else console.log(xhr.statusText);
            }
        });
    });
</script>


<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\EditUser', '#edit-user-form'); !!}

@endpush
