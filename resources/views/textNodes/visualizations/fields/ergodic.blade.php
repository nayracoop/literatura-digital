@if($story->textNodes->count() > 1 && isset($node))
<div class="col-xs-12 col-sm-9 ">
      @if(isset($node->next))
      <h2 class="invitacion-preguntas-ergodico">Ingresá las frases que invitan a seguir por otros nodos:</h2>
      <ul class="preguntas-ergodico">

        @foreach($node->next as $nn)
        <li data-nodo-id="{{$nn['id']}}">
          <button class="delete-pregunta-ergodico delete-node">Desasociar nodo</button>
          <label for="pregunta1" class="invisibilizar">Pregunta 1</label>
          <input type="text" class="form-control input-pregunta-ergodico" id="pregunta1">
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
{{--
<div class="col-md-4 col-lg-3">
<h2 class="tit-usuario">Elegí un nodo</h2>
<hr />
  <ul class="listado-nodos-ergodicos">
        <li data-nodo-id="200">
          <h3>La impresora</h3>
          <hr />
          <p>La mayoría de las tradiciones y supersticiones que surgen del hacha suelen aludir a la hoja de esta...</p>
          <div class="container-checkbox">
            <div class="check-left">
              <div class="check">
                <label class="checkbox" for="asociar1"><input name="asociar1" checked="checked" type="checkbox" id="asociar1"><span class="tick"></span>Asociar nodo</label>
              </div>
           </div>
          </div>
          <a href="#" class="dia">Leer nodo</a>
        </li>
        <li data-nodo-id="201">
          <h3>Las cosas que perdimos en el fuego</h3>
          <hr />
          <p>Tradiciones y supersticiones qgen del hacha suelen aludir a la hoja de esta...</p>
          <div class="container-checkbox">
            <div class="check-left">
              <div class="check">
                <label class="checkbox" for="asociar2"><input name="asociar2" type="checkbox" id="asociar2"><span class="tick"></span>Asociar nodo</label>
              </div>
           </div>
          </div>
          <a href="#" class="dia">Leer nodo</a>
        </li>
        <li data-nodo-id="203">
          <h3>la manera en que se debe</h3>
          <hr />
          <p>Tradiciones y supersticiones qgen del hacha suelen aludir a la hoja de esta...</p>
          <div class="container-checkbox">
            <div class="check-left">
              <div class="check">
                <label class="checkbox" for="asociar3"><input name="asociar3" type="checkbox" id="asociar3"><span class="tick"></span>Asociar nodo</label>
              </div>
           </div>
          </div>
          <a href="#" class="dia">Leer nodo</a>
        </li>
        <li data-nodo-id="230">
          <h3>El hacha</h3>
          <hr />
          <p>Tradiciones y supersticiones qgen del hacha suelen aludir a la hoja de esta...</p>
          <div class="container-checkbox">
            <div class="check-left">
              <div class="check">
                <label class="checkbox" for="asociar4"><input name="asociar3" type="checkbox" id="asociar4"><span class="tick"></span>Asociar nodo</label>
              </div>
           </div>
          </div>
          <a href="#" class="dia">Leer nodo</a>
        </li>
  </ul>
  </div>--}}
