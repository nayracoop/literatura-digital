@extends('layouts.main')
@section('title') @lang('Nuevo relato') @endsection  

@push('stylesheets')
<link href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/css/selectize.default.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/css/selectize.bootstrap3.min.css.map" />
@endpush

@section('content')
  <div class="fondo-forms">
    <div class="container formulario form-detalle">
      <div class="row">
        <div class="col-lg-12">
          <h1><span class="numero">1<span class="invisibilizar">.</span></span>@lang('Completá algunos detalles de tu relato.')</h1>
        </div>
          
        <form role="form" id="story-form">
          <div class="col-md-8">
            <div class="form-padding-interno">
              <label for="nombre">@lang('Título') *</label>
              <input type="text" class="form-control" id="titulo" name="title">
              <label for="mensaje">@lang('Descripción') *</label>
              <textarea class="form-control" id="mensaje" name="description">
              </textarea>
              <div class="row">
                <div class="col-md-6">
                  <label for="tipologia">@lang('Tipología') *</label>
                  <div class="styled-select">
                    <select type="text" class="form-control" id="tipologia" name="typology">
                      <option value="episodic">Episódico</option>
                      <option value="choral" >Coral</option>
                      <option value="rizome" >Hipertexto</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">  
                  <label for="genero">@lang('Género') *</label>
                  <div class="styled-select">
                    <select type="text" class="form-control" id="genero" name="genre">
                     @foreach( \App\Models\Genre::all() as $genre )
                     <option  value="{{$genre->slug}}">{{$genre->name}}</option>
                     @endforeach
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <label for="portada">@lang('Portada del relato')</label>
            <div class="portada-border">
              <img src="img/img-2.jpg" alt="" />
            </div>
            <input type="file" class="form-control portada-archivo" name="cover_drag" id="portada">
            <h2>Etiquetas</h2>
            <div class="tag-group">
            @if( isset( $story ))
            @foreach( $story->tags as $tag )
              <div class="tag-item"><p>{{ $tag->name }}<p><button>@lang('Eliminar etiqueta')</button>
                  <input type="hidden"  name="tags[]" value="{{ $tag->name }}" />
              </div>
            @endforeach
            @endif              
            </div>         
            <label for="tag" class="more-tags-title">@lang('Agregar etiqueta'):</label>
            <input type="text" class="form-control more-tags-input" id="tag" />
            <button id="add_tag" class="more-tags-bot">@lang('Agregar etiqueta')</button>
          </div>  
        </form>

        <div class="botones-nav-form">
          <a href="#" class="bot ant">@lang('Cancelar')</a>
          <a href="#" class="bot sig">@lang('Empezá a escribir')</a>
        </div>

        </div>
      </div>
    </div>
  </div>
 @endsection

 @push('javascript')
 <script type="text/javascript">
 /* Upload de imagen */
        $('input[type="file"]').change(function() {           
            var files =  this.files;
            for(var i = 0; i < files.length; i++) {                
                var formData = new FormData();
                var xhr = new XMLHttpRequest();
                formData.append('cover', files[i]);              
                formData.append('_token', '{{ csrf_token() }}');                
                xhr.open("POST", '{{ route( 'upload-picture' ) }}');
                xhr.send(formData);
            }

            xhr.addEventListener("readystatechange", function(e) {
                    var xhr = e.target;
                    if (xhr.readyState == 4) {

                        if(xhr.status == 200) {
                            // Acá actualizo la imagen   
                            console.log(xhr.response);
                           
                            newResponse = JSON.parse( xhr.response);
                             // console.log(JSON.parse( xhr.response).fileName  ); 
                             newImg = newResponse.picUrl;  
                             picName = newResponse.picName;   
                            // console.log(hash+'  -  '+ newImg ); //  
                            $('.portada-border' ).find('img').remove();  
                            $('.portada-border' ).append('<img src="'+newImg+'" />'); 
                            $('form').append('<input type="hidden" name="cover" value="'+picName+'" />');                                                         
                             //$('#cover-'+hash).value(  newId);                      

                        } else console.log(xhr.statusText);
                    }
                });
        });


 /* Guardar Borrador */   
  $('.bot.sig').on('click',function(e) {      

    e.preventDefault();
    var formElement = document.getElementById("story-form");
    var xhr = new XMLHttpRequest();   
    var formData = new FormData( formElement ); 
    formData.append('status', 'draft');             
    formData.append('_token', '{{ csrf_token() }}');                
    xhr.open("POST", '{{ route( 'save-story' ) }}');
    xhr.send(formData);
    
    xhr.addEventListener("readystatechange", function(e) {
                    var xhr = e.target;
                    if (xhr.readyState == 4) {
    
                        if(xhr.status == 200) {
                            
                            console.log('200');               
                            newResponse = JSON.parse( xhr.response);
                            var slug = newResponse.slug;                                                         
                            $('#story-form').append('<input type="hidden" name="slug" value="'+slug+'" />');     
                            // similar behavior as an HTTP redirect
                            @if( isset($story) )
                            window.location.replace("{{ route('node.create',$story->slug) }}");
                            @else
                            window.location.replace("{{ route('stories') }}/"+slug+"/nuevo-fragmento");
                            @endif
                            // similar behavior as clicking on a link
                            // window.location.href = "http://stackoverflow.com";  

                        } else console.log(xhr.statusText);
                    }
                });
 });
 

</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/standalone/selectize.min.js"></script>

<script>


  $('#add_tag').on('click', function(e){
    e.preventDefault();
    var tag = $('#tag').val(); 
   
    $(".tag-group").append('<div class="tag-item"><p>'+tag+'<p><input type="hidden" name="tags[]" value="'+tag+'" /><button>@lang('Eliminar etiqueta')</button></div>');
    $('#tag').val('');
    //console.log($select);
  });      


  $('.tag-item').on('click', function(e){
      $(this).remove();
  });



</script>
 @endpush