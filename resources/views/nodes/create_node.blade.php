@extends('layouts.main')
@section('title') @lang('Nuevo relato') @endsection  
@section('content')
       <div class="fondo-forms">
    <div class="container formulario form-detalle">
          
          <div class="row">
            <div class="col-lg-12">
              <h1><span class="numero">2<span class="invisibilizar">.</span></span> Escribí tu primer nodo.</h1>
            </div>
          </div>

        <form role="form" method="POST" action="{{ route('node.store',$story->slug) }}" >
          {{ csrf_field() }}
          <div class="row">
            <div class="col-sm-9 tit-nodo">
              <div class="form-padding-interno">
                <label for="titulo">Título <i>(opcional)</i></label>
                <input type="text" class="form-control" id="titulo" name="title">
              </div>  
            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 col-sm-9">
              <label for="texto-nodo" class="invisibilizar">Texto *</label>
              <div id="texto-nodo"  ></div>
            </div>
            <div class="col-xs-12 col-sm-3 contador">
              <h2 class="invisibilizar">Contador de caracteres y palabras del nodo</h2>
              <p><strong class="contador-palabras">0</strong> palabras</p>
              <p><strong class="contador-caracteres">0</strong> caracteres</p>
            </div>
          </div>

        <div class="row">  
          <div class="col-md-9">
            <div class="container-botones">
              <div class="botones-save-form">
                <button class="btn btn-cancelar">Cancelar</button>
                <button type="submit" class="btn btn-guardar">Guardar</button>
              </div>
              <div class="botones-nav-form">
                <a href="#" class="bot ant">Volver a detalles</a>
              </div>
            </div>
          </div>
        </div>
        <textarea name="text" class="invisible"></textarea>
        </form>

      </div>
    </div>

@endsection

@push('javascript')
<link rel="stylesheet" href="js/libs/simplebar/simplebar.css">
  <script src="js/libs/simplebar/simplebar.js"></script>

  <link href="{{asset('js/libs/summernote/summernote.css')}}" rel="stylesheet">
  <script src="{{asset('js/libs/summernote/summernote.es.min.js')}}"></script>
  <script src="{{asset('js/functions-summernote.js')}}"></script>
@endpush