@extends('layouts.main')
@section('title') @lang('Nuevo relato') @endsection  
@section('content')
    <div class="row">
      <form class="form-horizontal" role="form" method="POST" action="{{ route('story.store') }}" enctype="multipart/form-data">
      <div class="col-lg-8">

        <h1>@lang('Detalles del relato')</h1>

        
          {{ csrf_field() }}
          <div class="form-group">
            <label class="control-label">@lang('Título')</label>
            <input type="text" class="form-control" placeholder="Leñador" name="title">
          </div>
          <div class="form-group">
            <label for="inputPassword" class="control-label">@lang('Descripción')</label>
            <textarea class="form-control" rows="10" name="description"></textarea>
          </div>
          <div class="form-group">
            <label class="control-label">@lang('Tipología')</label>
            <select class="form-control" name="typology">
              <option selected="selected" value="coral">@lang('Coral')</option>
              <option selected="selected" value="episodico">@lang('Episódico')</option>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">@lang('Género')</label>
            <select class="form-control" name="genre">
              @foreach( \App\Models\Genre::all() as $genre )
              <option  value="{{$genre->slug}}">{{$genre->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">@lang('Etiquetas')</label>
            <input type="text" class="form-control" placeholder="Agregar etiquetas" name="label">
          </div>

          
          <button type="submit" class="btn btn-default">@lang('Publicar')</button>
          <button class="btn btn-default">@lang('Guardar Borrador')</button>

     
      </div>

      <div class="col-lg-4">
      <div class="well">
          <h4>@lang('Portada')</h4>
          <div class="media-item">
                <img alt="" src="{{ asset( 'img/tapa150x200.png' )}}">
          </div>
        <label for="portada">@lang('Cargar portada'):</label>
        <input type="file" name="cover" id="portada" style="width: 90%;" value="">
      </div>
    </div>
     </form>
  </div>
 @endsection