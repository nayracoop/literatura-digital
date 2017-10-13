@extends('layouts.main')
@section('title') @lang('Mi perfil') @endsection  
@section('content')
<div class="row">
      <div class="col-lg-7">

        <h1>@lang('Mi cuenta')</h1>

        <form class="form-horizontal" role="form">
          <div class="form-group">
            <label class="control-label">@lang('Email')</label>
            <input type="text" class="form-control" placeholder="Leñador">
          </div>
          <div class="form-group">
            <label class="control-label">@lang('Contraseña')</label>
            <input type="text" class="form-control" placeholder="Leñador">
          </div>
          <div class="form-group">
            <div class="row">
              <h3>@lang('Fecha de nacimiento')</h3>
              <div class="col-lg-2">
                <label class="control-label">@lang('Día')</label>
                <select class="form-control">
                  <option selected="selected" value="">01</option>
                  <option selected="selected" value="">02</option>
                </select>
              </div>
              <div class="col-lg-2">
                <label class="control-label">Mes</label>
                <select class="form-control">
                  <option selected="selected" value="">Marzo</option>
                  <option selected="selected" value="">Abril</option>
                </select>
              </div>
              <div class="col-lg-2">
                <label class="control-label">Año</label>
                <select class="form-control">
                  <option selected="selected" value="">1996</option>
                  <option selected="selected" value="">1997</option>
                </select>
              </div>
            </div>
          </div>
        </form>
      
      <button type="submit" class="btn btn-default">@lang('Guardar')</button>
      <button class="btn btn-default">@lang('Cancelar')</button>

      </div>

      <div class="col-lg-4 col-lg-offset-1">
      <div class="well">
          <h4>@lang('Foto de perfil')</h4>
          <div class="media-item">
                <img alt="" src="{{ asset('img/tapa150x200.png')}}">
          </div>
        <label for="portada">@lang('Cargar foto'):</label>
        <input type="file" name="portada" id="portada" style="width: 90%;" value="">
      </div>
    </div>

    </div>
@endsection