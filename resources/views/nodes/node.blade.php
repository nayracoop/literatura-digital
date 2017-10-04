@extends('layouts.main')
@section('title') {{ $story->title }} de Mike Wilson  @endsection  
@section('content')
<div class="row">
  <div class="col-lg-8">
        <h1>{{$textNode->title}}</h1>
    <hr>
    <p>{{$textNode->text}}</p>        
  </div>
</div>
@endsection

