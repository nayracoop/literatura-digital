@extends('layouts.main')
@section('title') @lang('Buscar Relatos') @endsection
@section('body_class') class="white" @endsection
@section('content')

    <div class="container listado-container">
    <div class="row">
      <div class="col-md-12 listado">
      		<h1 class="sr-only">Buscar relatos</h1>
        <div class="row">
          <div class="col-md-12">      
          <div class="buscador">
              <form>
                <label for="search" class="sr-only">Buscar:</label>
                <input type="text" name="search" placeholder="Buscar relatos">
              </form>
            </div>  
    @include('snippets.featured_stories')    
</div></div></div>
</div></div>
 
@endsection