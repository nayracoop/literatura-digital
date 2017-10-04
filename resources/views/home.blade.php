@extends('layouts.main')
@section('title') Inicio @endsection
@section('content')
	@include('snippets.about')   
    <hr>
    @include('snippets.voted_stories')    
    <hr>
    @include('layouts.footer')    
@endsection