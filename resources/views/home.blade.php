@extends('layouts.main')
@section('title') @lang('Inicio') @endsection
@section('content')
	@include('snippets.about')	
 
  <div class="container-fluid fondo-gris"  >
    <div class="container">
      <div class="row"> 
       <div class="col-sm-12"> 
    @include('snippets.featured_stories')    
       </div>   
      </div>
    </div>
  </div>
 
@endsection