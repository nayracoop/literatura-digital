@if($story->textNodes->count() > 1 && isset($node))
<div class="col-xs-12 col-sm-9 ">

      <h2 class="invitacion-preguntas-ergodico">Ingresá las frases que invitan a seguir por otros nodos:</h2>

      <ul class="preguntas-ergodico">

        @forelse($node->nextNodes as $nn)
        <li data-nodo-id="{{$nn->nodeId}}">
          <button class="delete-pregunta-ergodico delete-node">Desasociar nodo</button>
          <label for="pregunta1" class="invisibilizar">Pregunta {{$loop->index}}</label>
          <input type="hidden" name="nextNodeTag[]" value="{{$nn->nodeId}}">
          <input type="text" class="form-control input-pregunta-ergodico" id="pregunta-{{$loop->index}}" value="{{$nn->label}}" name="titleNode_{{$nn->nodeId}}">
          <div class="opciones-preguntas-ergodico">
            <div class="tit-preguntas-ergodico">
              <h2>{{$story->textNodes->find($nn->nodeId)->title}}</h2>
              <hr />
            </div>
            <div class="botones-preguntas-ergodico">
              <a href="#" class="dia">Leer nodo</a>
              <a href="#" class="asociar">Editar nodo</a>
            </div>
        </div>
        </li>
        @empty
        <li>No hay nodos asociados</li>
        @endforelse

      </ul>

      <button class="btn btn-nuevo-relato  btn-nuevo-nodo-ergodico asociar"><span>Asociar nodo</span><span class="plus"></span></button>
</div>
@endif
@include('snippets.visualizations.ergodic-associate')
@push('javascript')
<script type="text/javascript">
$('.delete-node').click(function(e){
   e.preventDefault();
   $(this).parent().remove();
});

$('.btn-nuevo-nodo-ergodico').click(function(e){
    e.preventDefault();
});

</script>

@endpush
