@extends('layouts.main')
@section('title') {{ $story->title }} de Mike Wilson  @endsection  
@section('content')
    <div class="row">
      <div class="col-lg-8">
        <div class="media-item pull-left" style="margin-right: 20px;  margin-bottom: 15px;">
          <img alt="" src="./relato_files/tapa150x200.png">
        </div>
        <div>
          <h1>{{ $story->title }}</h1>
          <p class="lead">De <a href="http://bardo.surwww.com/relato.html#">Mike Wilson</a></p>
          <p><span class="glyphicon glyphicon-time"></span>Publicado {{ $story->published_at }}</p>
        </div>

        <hr style="clear: both;">
        
        <div class="row text-center ">
          @if( $story->textNodes->count() > 0 )
            @foreach( $story->textNodes as $textNode )
              @include('nodes.summary')
            @endforeach
          @else
            <div class="col-lg-4 col-md-6">No hay fragmentos</div>
          @endif       
          
        </div>
        <hr>
        @include('snippets.comments')       

      </div>

      <div class="col-lg-4">       
        @include('snippets.like')
        @include('snippets.search')        
    </div>
@endsection

