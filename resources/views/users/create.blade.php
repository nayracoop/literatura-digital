@extends('layouts.main')

@section('title')
@lang('messages.new_user')
@endsection

@section('content')
<div class="fondo-forms">
    <div class="container formulario form-detalle">
        <div class="row">
            <div class="col-lg-12">
                <h1>@lang('messages.new_user')</h1>
                <hr />
            </div>
            <form role="form" method="post" action="{{ route('admin.user.store') }}" id="create-user-form">
                {{ csrf_field() }} 
                {{ method_field('POST') }}
                <div class="col-md-8">
                    <div class="form-padding-interno">
                        <label for="nombre">@lang('messages.user_name') *</label>
                        <input type="text" class="form-control" id="nombreusuario" value="" name="username">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" value="" name="first_name">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" id="apellido" value="" name="last_name">
                        <label for="sobre">Sobre mí</label>
                        <textarea class="form-control" id="sobre" name="description"></textarea>
                        <label for="email">Email *</label>
                        <input type="text" class="form-control" id="email" value="" name="email">
                        <label for="role">@lang('messages.role') *</label>
                        <div class="styled-select">
                            <select type="text" class="form-control" id="role" name="role">                                
                                <option value="" disabled selected></option>
                                    @lang("messages.select_option")
                                </option>
                                <option value="{{ App\Models\Enums\UserType::ADMIN }}">
                                    {{ ucfirst(App\Models\Enums\UserType::ADMIN) }}
                                </option>
                                <option value="{{ App\Models\Enums\UserType::MOD }}">
                                    {{ ucfirst(App\Models\Enums\UserType::MOD) }}
                                </option>
                                <option value="{{ App\Models\Enums\UserType::AUTHOR }}">
                                    {{ ucfirst(App\Models\Enums\UserType::AUTHOR) }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="portada">Imagen del usuario</label>
                    <div class="portada-border">
                        <img src="{{asset('img/img-usuario.jpg')}}" alt="" />
                    </div>
                    <input type="file" class="form-control portada-archivo" id="portada">
                </div>
                <div class="col-md-8">
                    <div class="container-botones">
                        <div class="botones-save-form">
                            <button class="btn btn-cancelar">@lang('messages.cancel')</button>
                            <button type="submit" class="btn btn-guardar">@lang('messages.create')</button>
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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/standalone/selectize.min.js"></script>

<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\CreateUser', '#create-user-form'); !!}

@endpush
