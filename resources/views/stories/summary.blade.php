 <div class="item-relato">
              <div class="item-relato-padding">
                <a href="{{ route('story.show', $story->slug ) }}">
                  <div class="media-item">
                    @if(  $story->cover != null && !empty($story->cover)  )
        <img alt="@lang('tapa de') {{$story->title}}" src="{{ asset('imagenes/cover/'.$story->cover )}}">        
        @else
        <img alt="" src="{{ asset('img/tapa200x200.png')}}"> 
        @endif
                  </div>
                  <h2>{{$story->title}}</a></h2>
                  <p class="autor">@lang('De') <a href="{{ route('author.show', $story->author->slug) }}">{{ $story->getAuthorName() }}</a></p>
                </a>
                <hr />
                <p>{{$story->description}}</p>
                <ul class="generos">
                  <li><a href="#">{{$story->genre}}</a></li>
                </ul>
                @include('stories.audience')               
              </div>
</div>