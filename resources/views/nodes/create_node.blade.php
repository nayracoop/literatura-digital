@extends('layouts.main')
@section('title') @lang('Nuevo relato') @endsection  
@section('content')
    <div class="row">
      <div class="col-lg-8 col-lg-offset-2">

      <form class="form-horizontal" role="form" method="POST" action="{{ route('node.store',$story->slug) }}">
        {{ csrf_field() }}
        <div class="form-group">
          <label class="control-label">@lang('Título')</label>
          <input type="text" class="form-control" placeholder="Fragmento 1 Sin Título" name="title">
        </div>
        <div class="form-group">
          <label for="inputPassword" class="control-label">@lang('Editor de texto')</label>
          <textarea class="form-control" rows="20" name="text"></textarea>
        </div>

        <button type="submit" class="btn btn-default">@lang('Publicar')</button>
        <button class="btn btn-default">@lang('Guardar')</button>
        <button class="btn btn-default">@lang('Vista previa')</button>
      </form>
      
      </div>

      </div>
@endsection