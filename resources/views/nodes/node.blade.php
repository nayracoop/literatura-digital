@extends('layouts.main')
@section('title') {{ $story->title }} @lang('de') {{ $story->getAuthorName() }}  @endsection  
@section('content')
<div class="padding-container">
  <div class="row">
    <div class="background-nodo">
      <div class="col-lg-12">

          <h1>{{$textNode->title}}</h1>
          
          <div class="nodo-meta">
           <p class="nodo-meta-relato"><a href="{{ route('story.show', $story->slug ) }}" class="nodo-meta-titulo">{{ $story->title }}</a> @lang('De') <a href="{{ route('author.show', $story->author->slug) }}" class="nodo-meta-autor">{{ $story->getAuthorName() }}</a></p>
           <p class="nodo-fecha-relato">@lang('Publicado el') {{ $story->published_at or $story->created_at }}</p>
          </div>
          @include('stories.audience')
         
          <div class="nodo-texto">{!! $textNode->text !!}</div>
            
          {{--  Separamos la presentación de nodos de acuerdo a la tipologia --}}
          @include('typologies.node_links.'.$story->typology)   

      </div>

    </div>
  </div>
</div>
@endsection

