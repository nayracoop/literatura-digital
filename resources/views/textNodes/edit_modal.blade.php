<div class=" esconder" id="edit-node-modal">
  <div class="nodo-backdrop esconder"  tabindex="-1" role="dialog" aria-labelledby="tit-nodo" aria-hidden="true">
    <div class="container formulario form-detalle">
        <div class="row">
            <div class="col-lg-12">
                @if ($story->textNodes->count() > 0)
                    @include('snippets.stories.data')
                    <div class="publicar-nodo btn btn-guardar">
                        <a href="#">Publicar nodo</a>
                    </div>
                @else
                    <h1>
                        <span class="numero">2
                            <span class="invisibilizar">.</span>
                        </span>
                        @if (isset($node))
                            Editar fragmento
                        @else
                            Escribí tu primer nodo.
                        @endif
                    </h1>
                @endif
            </div>
        </div>

        <form id="node-form" role="form" method="POST" action="">
            {{-- route('node.store',$story->slug) --}} {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-9 tit-nodo">
                    <div class="form-padding-interno">
                        <label for="titulo">Título
                            <i>(opcional)</i>
                        </label>
                        <input type="text" class="form-control" id="titulo" name="title" @if(isset($node)) value="{{$node->title}}" @endif>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-9">
                    <label for="texto-nodo" class="invisibilizar">Texto *</label>
                    <div id="texto-nodo">@if(isset($node)){!!$node->text!!}@endif</div>
                </div>
                <div class="col-xs-12 col-sm-3 contador">
                    <h2 class="invisibilizar">Contador de caracteres y palabras del nodo</h2>
                    <p>
                        <strong class="contador-palabras">@if(isset($node)){{$node->wordCount}}@else 0 @endif</strong> palabras</p>
                    <input name="wordCount" type="hidden" />
                    <p>
                        <strong class="contador-caracteres">@if(isset($node)){{$node->charCount}}@else 0 @endif</strong> caracteres</p>
                    <input name="charCount" type="hidden" />
                </div>
            </div>

            <div class="row">
                <div class="col-md-9">
                    <div class="container-botones">
                        <div class="botones-save-form">

                            <button class="btn btn-cancelar">Cancelar</button>

                            <button type="submit" class="btn btn-guardar">Guardar</button>
                        </div>
                        
                    </div>
                </div>
            </div>
            <textarea name="text" class="hidden"></textarea>
            <input name="story" value="{{$story->_id}}" type="hidden" />
            <input name="id" type="hidden"  />
        </form>

    </div>
  </div>
  <a class="back-button back-button-bottom cerrar-nodo"  href="#">Volver</a>
</div>
@push('javascript')

<link href="{{asset('js/libs/summernote/summernote.css')}}" rel="stylesheet">
<script src="{{asset('js/libs/summernote/summernote.es.min.js')}}"></script>
<script src="{{asset('js/functions-summernote.js')}}"></script>
@include('textNodes.scripts.save-update')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\CreateTextNode') !!}
@endpush