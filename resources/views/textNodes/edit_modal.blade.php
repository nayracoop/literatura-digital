<div class="nodo-ergodico-backdrop-fondo esconder" id="edit-node-modal">
  <div class="nodo-ergodico-backdrop" id="ventana-nodo-ergodico" tabindex="-1" role="dialog" aria-labelledby="tit-nodo" aria-hidden="true">

  <a class="back-button cerrar-nodo close-arrow close-add-nodo-ergodico" href="#">Volver</a>

   <div class="row">
    <div class="col-md-8 col-lg-9">
      <h2 class="tit-usuario">Escribí un nodo nuevo</h2>
        <hr />
          <div class="formulario">
            <input type="hidden" class="form-control" id="id" name="id">
            <input type="hidden" class="form-control" id="charCount" name="charCount">
            <input type="hidden" class="form-control" id="wordCount" name="wordCount">
            <form>
          <div class="row">
            <div class="col-md-10">
              <label for="titulo">Título <i>(opcional)</i></label>
              <input type="text" class="form-control" id="titulo" name="title">
            </div>

            <div class="col-md-10 nuevo-nodo-ergodico">
              <label for="texto-nodo" class="invisibilizar">Texto *</label>
              <div class="texto-nodo"></div>
            </div>
            <div class="col-xs-12 col-sm-3 contador">
                <h2 class="invisibilizar">Contador de caracteres y palabras del nodo</h2>
                <p>
                    <strong class="contador-palabras"></strong> palabras
                </p>
                <input name="wordCount" type="hidden" />
                <p>
                    <strong class="contador-caracteres"></strong> caracteres
                </p>
                <input name="charCount" type="hidden" />

                @if($story->getVisualization()->slug === 'ergodic' &&  ($story->textNodes->count() > 0) )
                <div class="orden-nodo">
                <label for="orden">Inicio</label>
                  <div class="styled-select">
                    <select name="first_node" type="text" class="form-control" id="orden">
                      <option   @if ( isset($node) && ($story->firstNode()->_id === $node->_id)) selected @endif value="1">Sí</option>
                      <option   @if ( !isset($node) || ($story->firstNode()->_id !== $node->_id)  ) selected @endif >No</option>
                    </select>
                  </div>
                </div>
                @endif

            </div>

          </form>
           </div>
          <div class="container-botones col-md-10">
            <div class="botones-save-form">
              <button class="btn btn-cancelar">Cancelar</button>
              <button type="submit" class="btn btn-guardar">Guardar</button>
            </div>
          </div>
        </div>
      </div>

   </div>

  </div>
</div>

@push('javascript')

<link href="{{asset('js/libs/summernote/summernote.css')}}" rel="stylesheet">
<script src="{{asset('js/libs/summernote/summernote.es.min.js')}}"></script>
<script src="{{asset('js/functions-summernote.js')}}"></script>
@include('textNodes.scripts.save-update')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\CreateTextNode') !!}
@endpush
