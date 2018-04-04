@extends('layouts.main')
@section('title')
@lang('Editar nodo')
@endsection
@section('content')
<div class="fondo-forms">
    <div class="container formulario form-detalle">
        <div class="row">
            <div class="col-lg-12">
                @if ($story->textNodes->count() > 0)
                    {{--  INFO DE LA ¡HISTORIA! EXISTENTE  --}}
                    @include ('snippets.stories.data')
                @else
                    {{--  PASO EN EL "WIZARD"  --}}
                    @include ('snippets.textNodes.step')
                @endif
            </div>
        </div>
        <form role="form" id="node-form" method="POST">
            {{--  CAMPOS DEL FORM  --}}
            @include ('snippets.textNodes.form_fields')
            @include ('snippets.textNodes.form_date_selection')
        </form>
        
        {{--  BOTONERA  --}}
        @include ('snippets.textNodes.form_buttons')
    </div>
</div>
@endsection

{{--  @section('content')
<div class="fondo-forms">
    <div class="container formulario form-detalle">
        <div class="row">
            <div class="col-lg-12">
                @if ($story->textNodes->count() > 0)
                    @include('snippets.stories.data')
                @else
                    <h1>
                        <span class="numero">2
                            <span class="invisibilizar">.</span>
                        </span>
                        @if (isset($node))
                            Editar fragmento
                        @else
                            Escribí tu primer nodo.
                        @endif
                    </h1>
                @endif
            </div>
        </div>

        <form id="node-form" role="form" method="POST" action="">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-9 tit-nodo">
                    <div class="form-padding-interno">
                        <label for="titulo">Título
                            <i>(opcional)</i>
                        </label>
                        <input type="text" class="form-control" id="titulo" name="title" @if(isset($node)) value="{{$node->title}}" @endif>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-9">
                    <label for="texto-nodo" class="invisibilizar">Texto *</label>
                    <div id="texto-nodo">@if(isset($node)){!!$node->text!!}@endif</div>
                </div>
                <div class="col-xs-12 col-sm-3 contador">
                    <h2 class="invisibilizar">Contador de caracteres y palabras del nodo</h2>
                    <p>
                        <strong class="contador-palabras">@if(isset($node)){{$node->wordCount}}@else 0 @endif</strong> palabras</p>
                    <input name="wordCount" type="hidden" />
                    <p>
                        <strong class="contador-caracteres">@if(isset($node)){{$node->charCount}}@else 0 @endif</strong> caracteres</p>
                    <input name="charCount" type="hidden" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-9">
                    <div class="container-botones">
                        <div class="botones-save-form">
                            <button class="btn btn-cancelar">Publicar</button>
                            <button type="submit" class="btn btn-guardar">Guardar</button>
                        </div>
                        <div class="botones-nav-form">
                            <a href="{{route('nodes.index', $story->_id)}}" class="bot ant">Volver al listado de nodos</a>
                        </div>
                    </div>
                    <div class="guardado" role="alert">
                        <div class="success">Tus cambios <strong>fueron guardados</strong>.</div>
                    </div>
                </div>
            </div>

            <textarea name="text" class="hidden"></textarea>
           
            <input name="story" value="{{$story->_id}}" type="hidden" /> @if(isset($node))
            <input name="id" type="hidden" value="{{$node->_id}}" /> @endif
        </form>

    </div>
</div>
@endsection  --}}
@push('javascript')
    @include('textNodes.scripts.save-update')
    @include('textNodes.scripts.upload-picture')
    <link href="{{asset('js/libs/summernote/summernote.css')}}" rel="stylesheet">
    <script src="{{asset('js/libs/summernote/summernote.es.min.js')}}"></script>
    <script src="{{asset('js/functions-summernote.js')}}"></script>    
    <script>
        @if (isset($node))
            $('textarea[name="text"]').html($('.note-editable').html());
            updateCount();
        @endif
    </script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\CreateTextNode') !!}
@endpush
