@extends('layouts.main')
@section('title') {{ $story->title }} @lang('de') {{ $story->getAuthorName() }}  @endsection  
@section('content')
    <div class="row">
      <div class="col-sm-12">
        <div class="padding-relato">
          <div class="relato">
            <div class="row">
              <div class="col-sm-3">
                <div class="media-relato">
                  @if(  $story->cover != null && !empty($story->cover)  )
                  <img alt="@lang('tapa de') {{$story->title}}" src="{{ asset('imagenes/cover/'.$story->cover )}}">        
                  @else
                  <img alt="" src="{{ asset('img/tapa200x200.png')}}"> 
                  @endif
                </div>
              </div>

              <div class="col-sm-9">
                  <h1>{{ $story->title }}</h1>
                  <p class="lead">@lang('De') <a href="{{ route('author.show', $story->author->slug) }}">{{ $story->getAuthorName() }}</a></p>
                  
                  <p><span class="glyphicon glyphicon-time"></span>@lang('Publicado') {{ $story->published_at }}</p>
                  
                @include('snippets.like')
                <ul class="relato-nodos">
                 @if( $story->textNodes->count() > 0 )
                  @foreach( $story->textNodes as $textNode )
                  <li><h3><a href="{{ route('node.show', [$story->slug, $textNode->slug] ) }}">{{ $textNode->title }}</a></h3></li>
                  
                  @endforeach
                  @else
                  <div class="col-lg-4 col-md-6">@lang('No hay fragmentos')</div>
                 @endif  
                </ul>
                @include('author.new_node')
              </div>

            </div>

        <hr>
         @include('snippets.comments') 

      </div>
    </div>
</div>
</div>




@endsection

