@extends('layouts.main')
@section('title') @lang('Buscar Relatos') @endsection
@section('body_class')@endsection
@section('content')

<div class="fondo-forms editor-relato">
  <div class="container listado-relatos">
    <div class="row">
      <div class="col-md-12">
          <div class="data-relato">
            <div class="image-clip">
              @if(  $story->cover != null && !empty($story->cover)  )
              <img alt="@lang('tapa de') {{$story->title}}" src="{{ asset('imagenes/cover/'.$story->cover )}}">
              @else
              <img alt="" src="{{ asset('img/img-2.jpg')}}">
              @endif
            </div>
            <p class="tit-relato">{{ $story->title or ' --' }}</p>
            <p class="autor-relato">{{ $story->getAuthorName() }}</p>
          </div>

          <ul class="modos tabs" role="tablist">
            <li class="active"><a href="#modo-visualizacion">Modo visualización</a></li>
            <li><a href="#modo-listado">Modo listado de nodos</a></li>
          </ul>

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
              <script src="https://d3js.org/d3.v4.min.js" charset="utf-8"></script>
              <script>
                  var data = [4, 8, 15, 16, 23, 42];
                  var x = d3.scale.linear()
                      .domain([0, d3.max(data)])
                      .range([0, 100]);
                  d3.select(".ejemplo")
                    .selectAll("div")
                      .data(data)
                    .enter().append("a")
                      .style("width", function(d) { return x(d)  + "%"; })
                      .text(function(d) { return d; });
              </script>
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

          <div id="modo-listado" class="tabpanel">
            <h1>Listado de nodos</h1>
            <hr />

            <table summary="Lista de nodos del relato">
            <caption class="invisibilizar">Lista de nodos del relato</caption>
            <thead>
              <tr>
                <th scope="col" class="ordenar"><a href="#">Orden</a></th>
                <th scope="col"><a href="#">Nombre</a></th>
                <th scope="col" class="ocultar-sm"><a href="#">Fecha</a></th>
                <th class="ocultar-lg" scope="col"><a href="#">Caracteres</a></th>
                <th scope="col"  class="ocultar-sm"><a href="#">Estado</a></th>
                <th scope="col"><span class="invisibilizar">Editar</span></th>
              </tr>
            </thead>
            <tbody>
              @foreach( $story->textNodes as $node )
              <tr>
                <td>{{$loop->iteration}}</td>
                <td class="tit-listado">{{$node->title or '--'}}</td>
                <td class="ocultar-sm">{{ date('d.m.Y', strtotime($node->created_at) ) }}</td>
                <td class="ocultar-lg">{{ $node->charCount }}</td>
                <td class="ocultar-sm">Activado</td>
                <td><a href="{{route('author.story.nodes.edit',[$story->id,$node->id])}}"><button>Editar</button></td>
              </tr>
              @endforeach
            </tbody>
            </table>
          </div>

            <a href="{{route('node.create',$story->_id)}}" ><button class="btn btn-nuevo-relato"><span>Agregar nodo</span><span class="plus"></span></button></a>

          <div class="botones-nav-form">
              <a href="#" class="bot ant">Volver a mis relatos</a>
              <a href="#" class="bot sig">Ir a detalles del relato</a>
          </div>

      </div>
    </div>
  </div>
</div>
@endsection

@push('javascript')
<script>
//formElement = document.getElementById("stories_search");
$('stories_search').on('submit',function(e){
  e.preventDefault();
});
$('input[name="search"]').bind('input',function(){
  console.log('gato');
  formElement = document.getElementById("stories_search");

  var xhr = new XMLHttpRequest();
    var formData = new FormData( formElement );

    formData.append('_token', '{{ csrf_token() }}');
    console.log(formData);
   // formData.append('_method', 'PATCH');
    xhr.open("POST", '{{ route( 'stories.search') }}');
    xhr.send(formData);

    xhr.addEventListener("readystatechange", function(e) {
                    var xhr = e.target;
                    if (xhr.readyState == 4) {
  //  console.log('h');
                        if(xhr.status == 200) {

                            console.log('200');
                            newResponse = JSON.parse( xhr.response);
                            var results = newResponse.results;
                            $('.items-listado').empty();
                            $('.items-listado').append(results);
                        } else console.log(xhr.statusText);
                    }
    });

});

</script>
@endpush
