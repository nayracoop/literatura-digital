<div class="nodo-backdrop-fondo esconder">
@foreach($story->textNodes as $node)

  <div class="nodo-backdrop esconder" id="ventana-nodo-{{ $node->_id }}" tabindex="-1" role="dialog" aria-labelledby="tit-nodo" aria-hidden="true">

        <a class="back-button cerrar-nodo close-arrow" data-node="{{$node->_id}}" href="#">{{__('messages.back')}}</a>

        <div class="nodo-data-relato">
          <a href="#" class="cerrar-nodo">
            <div class="image-clip">
              @if($story->cover != null && !empty($story->cover))
                  <img alt="@lang('tapa de') {{$story->title}}" src="{{ asset('imagenes/cover/'.$story->cover )}}">
                  @else
                  <img alt="" src="{{ asset('img/img-relato-default.jpg')}}">
              @endif
            </div>
            <p class="tit-relato">{{ $story->title }}</p>
            <p class="autor-relato">{{ $story->getAuthorName() }}</p>
          </a>
        </div>

        <div class="titulo-nodo">
          <h1 class="tit-nodo">{{ $node->title }}</h1>
          <span class="acento"><span></span></span>
        </div>

        <div class="container-nodo">{!!$node->text!!}</div>

        <a class="back-button back-button-bottom cerrar-nodo" data-node="{{$node->_id}}" href="#">{{__('messages.back')}}</a>

  </div>

@endforeach
</div>
