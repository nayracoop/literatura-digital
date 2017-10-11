@extends('layouts.main')
@section('title') Nuevo relato @endsection  
@section('content')
    <div class="row">
      <div class="col-lg-8">

        <h1>{{__("Detalles del relato")}}</h1>

        <form class="form-horizontal" role="form" method="POST" action="{{ route('story.store') }}">
          {{ csrf_field() }}
          <div class="form-group">
            <label class="control-label">Título</label>
            <input type="text" class="form-control" placeholder="Leñador" name="title">
          </div>
          <div class="form-group">
            <label for="inputPassword" class="control-label">Descripción</label>
            <textarea class="form-control" rows="10" name="description"></textarea>
          </div>
          <div class="form-group">
            <label class="control-label">Tipología</label>
            <select class="form-control" name="typology">
              <option selected="selected" value="coral">Coral</option>
              <option selected="selected" value="episodico">Episódico</option>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Género</label>
            <select class="form-control" name="gender">
              <option selected="selected" value="piratas">Piratas</option>
            </select>
          </div>
          <div class="form-group">
            <label class="control-label">Etiquetas</label>
            <input type="text" class="form-control" placeholder="Agregar etiquetas" name="label">
          </div>

          
          <button type="submit" class="btn btn-default">Publicar</button>
          <button class="btn btn-default">Guardar Borrador</button>

        </form>
      
     

      </div>

      <div class="col-lg-4">
      <div class="well">
          <h4>Portada</h4>
          <div class="media-item">
                <img alt="" src="{{ asset( 'img/tapa150x200.png' )}}">
          </div>
        <label for="portada">Cargar portada:</label>
        <input type="file" name="portada" id="portada" style="width: 90%;" value="">
      </div>
    </div>

  </div>
 @endsection