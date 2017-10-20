@extends('layouts.main')
@section('title') {{ $story->title }} @lang('de') {{ $story->getAuthorName() }}  @endsection  
@section('content')
<div class="row">
  <div class="col-lg-8">
    <h1>{{$textNode->title}}</h1>
    <hr>
    <p>{{$textNode->text}}</p>

   	<p></p> 	
   	@if( $textNode->next !== null )
    @foreach( $textNode->next as $next )
    	
    	<a  href="{{ route('node.show',[ $story->slug , $story->textNodes->find($next)->first()->slug ]) }}" >{{$story->textNodes->find($next)->first()->title}}</a>        
    	
    @endforeach
    @endif
  </div>
</div>
@endsection

