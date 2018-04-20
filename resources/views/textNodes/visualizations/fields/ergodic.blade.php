<div class="orden-nodo">
<label for="orden">Inicio</label>
  <div class="styled-select">
    <select name="first_node" type="text" class="form-control" id="orden">
      <option   @if (isset($node->firstNode) && $node->firstNode ) selected @endif value="1">Sí</option>
      <option   @if (!isset($node->firstNode) || !$node->firstNode ) selected @endif >No</option>
    </select>
  </div>
</div>

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
  </div>
