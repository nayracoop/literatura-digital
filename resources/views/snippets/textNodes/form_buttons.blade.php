<div class="row">  
    <div class="col-md-9">
        <div class="container-botones">
            <div class="botones-save-form">
                {{--  si estoy editando, voy a usar la URI para cambiar el estado  --}}
                <button type="button" class="btn btn-cancelar" @if (isset($node)) data-uri='{{ route("node.toggleStatus", $node->_id) }}' @endif>Publicar</button>
                <button type="button" class="btn btn-guardar">Guardar</button>
            </div>
            <div class="botones-nav-form">
                <a href="{{route('nodes.index', $story->_id)}}" class="bot ant">Ir al listado de nodos</a>
            </div>
        </div>

        {{--  MENSAJES DE CONFIRMACION  --}}
        <div class="guardado cambios exito" role="alert">
            <div class="success">
                @lang('messages.saved_confirmation')
            </div>
        </div>
        <div class="guardado estado exito" role="alert">
            <div class="success">
                @lang('messages.status_changed_confirmation')
            </div>
        </div>
        <div class="guardado error" role="alert">
            <div class="error">
                @lang('messages.saved_error')
            </div>
        </div>
    </div>
</div>