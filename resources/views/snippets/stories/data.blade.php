<div class="data-relato">
    <div class="image-clip">
        @if($story->cover != null && !empty($story->cover))
            <img alt="@lang('tapa de') {{$story->title}}" src="{{ asset('imagenes/cover/'.$story->cover )}}"> @else
            <img alt="" src="{{ asset('img/img-relato-default.jpg')}}">
        @endif
    </div>
    <p class="tit-relato">{{ empty($story->title) ? '-' : $story->title }}</p>
    <p class="autor-relato">{{ $story->getAuthorName() }}</p>
</div>
