@extends('layouts.main')
@section('title') {{ $story->title }} @lang('de') {{ $story->getAuthorName() }}  @endsection  
@section('content')
<div class="fondo-forms">
    <div class="container listado-relatos">
      <div class="row">         
        <div class="col-md-12">
            <div class="data-relato">
              <div class="image-clip">
                  @if(  $story->cover != null && !empty($story->cover)  )
                  <img alt="@lang('tapa de') {{$story->title}}" src="{{ asset('imagenes/cover/'.$story->cover )}}">        
                  @else
                  <img alt="" src="{{ asset('img/img-3.jpg')}}"> 
                  @endif
                
              </div>  
              <p class="tit-relato">{{ $story->title }}</p>
              <p class="autor-relato">{{ $story->getAuthorName() }}</p>
            </div>

            <h1>Interface temporaria del relato</h1>
            <hr />
              
            <table summary="Lista">
            <caption class="invisibilizar">Lista</caption>
            <thead>
              <tr>
                <th scope="col" class="ordenar"><a href="#">Orden</a></th>
                <th scope="col"><a href="#">Nombre</a></th>
                <th scope="col" class="ocultar-sm"><a href="#">Fecha</a></th>
                <th class="ocultar-lg" scope="col"><a href="#">Caracteres</a></th>
                <th scope="col"><span class="invisibilizar">Leer</span></th>
              </tr>
            </thead>
            <tbody>
              @forelse($story->textNodes as $node)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="tit-listado">{{ $node->title }}</td>
                <td class="ocultar-sm">{{ date('d.m.Y', strtotime($node->published_at) ) }}</td>
                <td class="ocultar-lg">2000</td>
                <td><button class="leer" data-node="{{$loop->iteration}}">Leer</button></td>
              </tr>
              @empty
              <tr>
                <td colspan="5" >No hay fragmentos</td>               
              </tr>
              @endforelse
              
            </tbody>
            </table>

            <div class="botones-nav-form">

            </div>

        </div>
      </div>
    </div>
  </div>
  @foreach($story->textNodes as $node)
  <div class="nodo-backdrop esconder" id="ventana-nodo-{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="tit-nodo" aria-hidden="true">

        <a class="back-button cerrar-nodo" data-node="{{$loop->iteration}}" href="#">Volver</a>

        <div class="nodo-data-relato">
          <a href="#" class="cerrar-nodo">
            <div class="image-clip">
              @if(  $story->cover != null && !empty($story->cover)  )
                  <img alt="@lang('tapa de') {{$story->title}}" src="{{ asset('imagenes/cover/'.$story->cover )}}">        
                  @else
                  <img alt="" src="{{ asset('img/tapa200x200.png')}}"> 
              @endif
            </div>  
            <p class="tit-relato">{{ $story->title }}</p>
            <p class="autor-relato">{{ $story->getAuthorName() }}</p>
          </a>  
        </div>

        <div class="titulo-nodo">
          <h1 id="tit-nodo">{{ $node->title }}</h1>
          <span class="acento"><span></span></span>
        </div>

        <div class="container-nodo">{!!$node->text!!}</div>

        <a class="back-button back-button-bottom cerrar-nodo" data-node="{{$loop->iteration}}" href="#">Volver</a>

  </div>
  @endforeach


@endsection

@push('javascript')
<script >

/* Guardar Borrador */    

$('.editable button').on('click',function(e) {      

    e.preventDefault();  
    var formElement = $(this).parent();    
    formElement = document.getElementById(formElement.attr('id') );
    var xhr = new XMLHttpRequest();   
    var formData = new FormData( formElement ); 
     
    formData.append('_token', '{{ csrf_token() }}');   
    formData.append('_method', 'PATCH');             
    xhr.open("POST", '{{ route( 'update-story', $story->slug ) }}');
    xhr.send(formData);
    
    xhr.addEventListener("readystatechange", function(e) {
                    var xhr = e.target;
                    if (xhr.readyState == 4) {
  //  console.log('h');
                        if(xhr.status == 200) {
                            
                            console.log('200');               
                            newResponse = JSON.parse( xhr.response);
                            var input = newResponse.input;                                                                                   
                            $('h1').text(input); 
                        } else console.log(xhr.statusText);
                    }
                });

 });
 

</script>
@endpush
