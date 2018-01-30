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

          @include('typologies.node_presentation.user.'.$story->typology)

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
              <a href="{{route('author.stories')}}" class="bot ant">Volver a mis relatos</a>
              <a href="{{route('story.update',$story->id)}}" class="bot sig">Ir a detalles del relato</a>
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
  //console.log('gato');
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
