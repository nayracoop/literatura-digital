<div class="nodo-ergodico-backdrop-fondo esconder" id="edit-node-modal">
  <div class="nodo-ergodico-backdrop" id="ventana-nodo-ergodico" tabindex="-1" role="dialog" aria-labelledby="tit-nodo" aria-hidden="true">

  <a class="back-button cerrar-nodo close-arrow close-add-nodo-ergodico" href="#">Volver</a>

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
          @if($story->typology->slug === 'choral')
          @include('textNodes.visualizations.fields.'.$story->typology->slug)

          @elseif($story->typology->slug === 'ergodic')
          @include('textNodes.visualizations.fields.'.$story->typology->slug)
          @endif
      </form>
      {{--  BOTONERA  --}}
      @include ('snippets.textNodes.form_buttons')
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
