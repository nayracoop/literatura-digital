@extends('layouts.main')
@section('content')
	@include('snippets.about')   
    <hr>
    @include('snippets.voted_stories')    
    <hr>
    @include('layouts.footer')    
@endsection