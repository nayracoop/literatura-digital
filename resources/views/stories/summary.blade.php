
  <div class="thumbnail">
    <div class="caption">
      <div class="media-item">
        <img alt="" src="{{ asset('img/tapa150x200.png')}}">
      </div>
      <h3>{{$story->title}}</h3>
      <p class="lead">@lang('De') <a href="{{ route('author.show', $story->author->slug) }}">{{ $story->getAuthorName() }}</a></p>
      <p>{{ $story->description }}</p>

      <a href="http://bardo.surwww.com/home.html#">genero</a>
      <div>
        @if($story->views > 0)
          <span>@lang('Visto'): {{ $story->views }}</span>
        @endif 
        @if($story->likes->count() > 0)
          <span>@lang('Likeado'): {{ $story->likes->count() }}</span>
        @endif
        <span>@lang('Partes'): {{ $story->textNodes->count() }}</span>
      </div>

      <p><a href="{{ route('story.show', $story->slug ) }}" class="btn btn-primary">@lang('Leer!')</a></p>
    </div>
  </div>
