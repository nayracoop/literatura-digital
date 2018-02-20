@extends('layouts.main')
@section('title')
  {{ $story->title }} @lang('de') {{ $story->getAuthorName() }}
@endsection

@section('content')
<div class="fondo-forms">
    <div class="container">
      <div class="row leer-palabras">
        <div class="col-md-12">

            <div class="palabras">

              <h1>{{$story->title}}</h1>
              <p class="autor">{{$story->getAuthorName()}}</p>

             <ul>
               @foreach($story->textNodes as $node)
               <li><a class="leer" id="{{ $node->_id }}"  href="#">{{$node->title}}</a></li>
               @endforeach
             </ul>

             </div>
             <a href="#" class="btn-social">Compartir</a>
             <a href="#" class="btn-social">Me gusta</a>

        </div>
      </div>
    </div>
  </div>

  <div class="nodo-backdrop-fondo esconder">
  @foreach($story->textNodes as $node)

    <div class="nodo-backdrop" id="ventana-nodo-{{ $node->_id }}" tabindex="-1" role="dialog" aria-labelledby="tit-nodo" aria-hidden="true">

          <a class="back-button cerrar-nodo close-arrow" data-node="{{$node->_id}}" href="#">Volver</a>

          <div class="nodo-data-relato">
            <a href="#" class="cerrar-nodo">
              <div class="image-clip">
                @if($story->cover != null && !empty($story->cover))
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

          <a class="back-button back-button-bottom cerrar-nodo" data-node="{{$node->_id}}" href="#">Volver</a>

    </div>

  @endforeach
  </div>
  @include('snippets.comments.story')

@endsection

@push('javascript')
<script src="{{asset('js/libs/jquery.min.js')}}"></script>

<script src="{{asset('js/bootstrap.min.js')}}"></script>

<script>
  var posiciones = [ ['Animales', '120', '230'], ['Descanso', '110', '370'], ['Supersticiones','433','784'], ['Festejos', '75', '530'], ['Ventana', '74', '250'], ['Lluvia', '320', '580'], ['Leña', '450', '190'], ['Tradiciones', '250', '365'], ['Cielo', '480', '488'], [ 'Familia', '240', '466'], ['Interiores', '520', '40'], ['Reuniones', '756', '270'], ['Compañerismo', '248', '638'], ['Albañilería', '156', '545'], ['Cerveza', '688', '780'], ['Árboles', '326', '620'] ];

    var i=0;
    $('.palabras a').each(function() {
      var mult = 1;
      if($(window).width() < 992){
        var mult = 0.710;
      }
      $(this).parent().css({ 'top': + (posiciones[i][1] * mult) + 'px', 'left':  + (posiciones[i][2] * mult)  + 'px' })
      i++;
    });

    $('.palabras a').click(function() {
      if($('.nodo-backdrop-fondo').hasClass('esconder')){
        $('.nodo-backdrop-fondo').removeClass('esconder');
        $('body').addClass('overflow');
      }
      return false;
    });
  </script>
@endpush
