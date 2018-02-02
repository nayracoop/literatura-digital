<div id="modo-visualizacion" class="tabpanel active">
  <div class="row" style="clear: both;">
    <div class="col-sm-7 col-md-6 tit-editor-visual">
      <h1>Visualización</h1>
      <hr />
    </div>
  </div>

  <div class="row formulario" style="clear: both;">
    <div class="col-sm-7 col-md-6">
    <style>
      .ejemplo a {
        display: block;
        cursor: pointer;
        font: 10px sans-serif;
        background-color: steelblue;
        text-align: right;
        padding: 3px;
        margin: 1px;
        color: white;
      }
    </style>
    <div class="ejemplo"></div>
    <div class="modal-opciones-nodo">
      <h2>El hacha</h2>
      <hr />
      <a href="#">Leer nodo</a>
      <a href="#">Editor nodo</a>
    </div>

    </div>

    <div class="col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-2">
      <form role="form" class="opciones-visual">
        <label for="colores">Colores</label>
        <div class="styled-select">
          <select type="text" class="form-control" id="colores">
            <option>Terroso</option>
            <option>Violetas</option>
            <option>Fluo</option>
            <option>Primarios</option>
            <option>Fríos</option>
          </select>
        </div>
        <div class="container-checkbox">
          <div class="check-left">
            <div class="check">
              <label class="checkbox" for="aleatorio"><input name="aleatorio" checked="checked" type="checkbox" id="aleatorio"><span class="tick"></span>Orden aleatorio</label>
            </div>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>
@push('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.12.2/d3.js" charset="utf-8"></script>
<script>
@php
$nodes = [];
foreach ( $story->textNodes->sortBy('order') as $textNode ) {
  $nodes [] = $textNode->charCount !== null ? $textNode->charCount : 0 ;
}
$nodes = implode(',',$nodes);
@endphp
    var data = [{{$nodes}}];
    var x = d3.scaleLinear()
        .domain([0, d3.max(data)])
        .range([0, 100]);
    d3.select(".ejemplo")
       .selectAll("div")
        .data(data)
      .enter().append("a")
        .style("width", function(d) { return x(d)  + "%"; })
        .text(function(d) { return d; });
</script>
@endpush
