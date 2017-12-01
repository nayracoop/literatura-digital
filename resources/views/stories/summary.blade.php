 <article class="col-sm-12 col-md-6">
              <div class="card"> 
                <a href="{{ route('story.show', $story->slug ) }}">
                  
                  @if(  $story->cover != null && !empty($story->cover)  )
                  <img alt="@lang('tapa de') {{$story->title}}" src="{{ asset('imagenes/cover/'.$story->cover )}}">        
                  @else
                  <img alt="" src="{{ asset('img/img-3.jpg')}}"> 
                  @endif
                  <h3>{{$story->title}}</h3>
                  <p class="autor-relato"><a href="{{ route('author.show', $story->author->slug) }}">{{ $story->getAuthorName() }}</a></p>
                  <span><hr /></span>
                  <p class="resumen">{{$story->description}}</p>
                  <span class="ver-mas"></span>
                </a>
              </div>  
</article>