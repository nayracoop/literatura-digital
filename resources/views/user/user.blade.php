@extends('layouts.main')
@section('title') {{ $author->getName() }} @endsection  
@section('content')
    <div class="row">
      <div class="col-lg-8">
        <div>
          <h1>{{ $author->getName() }}</h1>
          <p class="lead">De <a href="http://bardo.surwww.com/usuario.html#">{{ $author->getName() }}</a></p>
          <p><span class="glyphicon glyphicon-time"></span>@lang('Miembro desde') {{ $author->created_at }}</p>
        </div>
        <hr style="clear: both;">        
        <div class="row text-center ">
        @foreach( $author->getStories() as $story )
            <div class="col-lg-4 col-sm-6">
          @include('stories.summary') 
        </div>
        @endforeach
        </div>
        <hr>
        @include('snippets.comments_author')
      </div>

      <div class="col-lg-4">
        @include('snippets.search')    
      </div>
    </div>
  </div>
@endsection