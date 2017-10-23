@extends('layouts.main')
@section('title') @lang('Inicio') @endsection
@section('content')
	@include('snippets.about')	
 <div class="container listado-container">
    <div class="row">
      <div class="col-md-12 listado">

        <div class="row">
          <div class="col-md-12">         
 
    @include('snippets.featured_stories')    
</div></div>
</div></div></div>
 
@endsection