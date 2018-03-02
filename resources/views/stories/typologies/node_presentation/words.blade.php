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

@push('javascript')
<script src="{{asset('js/libs/jquery.min.js')}}"></script>

<script src="{{asset('js/bootstrap.min.js')}}"></script>

<script>
  //var posiciones = [ [ '120', '230'], ['Descanso', '110', '370'] ];
    var posiciones = {!! json_encode($story->textNodes) !!}
    var i=0;
    $('.palabras a').each(function() {
      var mult = 1;
      if($(window).width() < 992){
        var mult = 0.710;
      }
  //    console.log('positionY '+posiciones[i].positionY);
  //    console.log('positionX '+posiciones[i].positionX);
      $(this).parent().css({ 'top': + (posiciones[i].positionY * mult) + 'px', 'left':  + (posiciones[i].positionX * mult)  + 'px' })
      i++;
    });

    $('.palabras a').click(function() {
      if($('.nodo-backdrop-fondo').hasClass('esconder')){
        $('.nodo-backdrop-fondo').removeClass('esconder');
        //$('body').addClass('overflow');
      }
      return false;
    });
  </script>
@endpush
