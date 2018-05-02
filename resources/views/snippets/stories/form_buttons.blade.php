{{--  BOTONERA  --}}
<div class="row">
    <div class="col-md-9">
        {{--  PARA EDICIÓN DE HISTORIA EXISTENTE  --}}
        @if (isset($story))
            <div class="container-botones">
                {{--  GUARDAR  --}}            
                <div class="botones-save-form">
                    <button class="btn btn-guardar" type="button">@lang('messages.save')</button>
                </div>
                {{--  VOLVER A LISTA DE NODOS  --}}
                <div class="botones-nav-form">
                    <a href="{{ route('nodes.index', [ 'story' => $story->slug ]) }}" class="bot ant">@lang('messages.return_to_nodes')</a>
                </div>
            </div>            
        {{--  PARA NUEVA HISTORIA  --}}
        @else                        
            {{--  HAY QUE GUARDAR LA HISTORIA Y REDIRIGIR A NUEVO NODO  --}}
            <div class="botones-nav-form">
                <a href="#" class="bot sig">@lang('messages.start_writing')</a>
            </div>
        @endif

        {{--  MENSAJE DE CONFIRMACION  --}}
        <div class="guardado exito" role="alert">
            <div class="success">
                @lang('messages.saved_confirmation')
            </div>
        </div>

        <div class="guardado error" role="alert">
            <div class="error">
                @lang('messages.saved_error')
            </div>
        </div>
    </div>
</div>
