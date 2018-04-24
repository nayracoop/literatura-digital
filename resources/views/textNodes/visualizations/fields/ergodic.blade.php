@if($story->textNodes->count() > 1 && isset($node))
<div class="col-xs-12 col-sm-9 ">
      @if(isset($node->next))
      <h2 class="invitacion-preguntas-ergodico">Ingresá las frases que invitan a seguir por otros nodos:</h2>
      <ul class="preguntas-ergodico">

        @foreach($node->next as $nn)
        <li data-nodo-id="{{$nn['id']}}">
          <button class="delete-pregunta-ergodico delete-node">Desasociar nodo</button>
          <label for="pregunta1" class="invisibilizar">Pregunta {{$loop->index}}</label>
          <input type="text" class="form-control input-pregunta-ergodico" id="pregunta{{$loop->index}}" value="{{$nn['title']}}" name="title-nodes-{{$node->_id}}[]">
          <div class="opciones-preguntas-ergodico">
            <div class="tit-preguntas-ergodico">
              <h2>{{$nn['title']}}</h2>
              <hr />
            </div>
            <div class="botones-preguntas-ergodico">
              <a href="#" class="dia">Leer nodo</a>
              <a href="#" class="asociar">Editar nodo</a>
            </div>
        </div>
        </li>
        @endforeach
      </ul>
      @endif
      <button class="btn btn-nuevo-relato  btn-nuevo-nodo-ergodico asociar"><span>Asociar nodo</span><span class="plus"></span></button>
</div>
@endif

@push('javascript')
<script type="text/javascript">
$('.delete-node').click(function(e){
   e.preventDefault();
   $(this).parent().remove();
});
</script>

@endpush
