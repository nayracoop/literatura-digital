<div class="data-relato relato-data-nodo">
  <div class="image-clip">
    @if(  $story->cover != null && !empty($story->cover)  )
        <img alt="@lang('tapa de') {{$story->title}}" src="{{ asset('imagenes/cover/'.$story->cover )}}">
        @else
        <img alt="" src="{{ asset('img/img-2.jpg')}}">
        @endif
  </div>
  <p class="tit-relato">{{ empty($story->title)?'-':$story->title  }}</p>
  <p class="autor-relato">{{$story->getAuthorName()}}</p>
</div>
