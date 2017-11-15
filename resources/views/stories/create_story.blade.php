@extends('layouts.main')
@section('title') @lang('Nuevo relato') @endsection  
@section('content')
    <div class="row">
      <form id="story-form" class="form-horizontal" role="form" method="POST" action="{{ route('story.store') }}" enctype="multipart/form-data">
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
              <option value="temporal">@lang('Temporal')</option>              
              <option value="lineal">@lang('Lineal')</option>
              <option value="episodic">@lang('Episódico')</option>
              <option value="choral">@lang('Coral')</option>
              <option value="rizome">@lang('Rizoma')</option>
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
            <input type="text" class="form-control" placeholder="@lang('Agregar etiquetas')" name="label">
          </div>
          
          <button type="submit" name="publish" class="btn btn-default">@lang('Publicar')</button>
          <button type="submit" name="save" value="draft" class="btn btn-default">@lang('Guardar Borrador')</button>
     
      </div>

      <div class="col-lg-4">
      <div class="well drag-and-drop-area">
          <h4>@lang('Portada')</h4>
          <div class="media-item">
                <img alt="" src="{{ asset( 'img/tapa200x200.png' )}}">
          </div>
        <label for="portada">@lang('Cargar portada'):</label>
        <input type="file" name="cover_drag" id="portada" style="width: 90%;" value="">
      </div>
    </div>
     </form>
  </div>
 @endsection
@php
$storyRoute = null;
@endphp
 @push('javascript')
 <script type="text/javascript">
 /* Autoupload */
        $('.drag-and-drop-area input[type="file"]').change(function() {           
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
                            //console.log(xhr.statusText);
                           
                            newResponse = JSON.parse( xhr.response);
                             // console.log(JSON.parse( xhr.response).fileName  ); 
                             newImg = newResponse.picUrl;  
                             picName = newResponse.picName;   
                            // console.log(hash+'  -  '+ newImg ); //  
                            $('.media-item' ).find('img').remove();  
                            $('.media-item' ).append('<img src="'+newImg+'" />'); 
                            $('form').append('<input type="hidden" name="cover" value="'+picName+'" />');                                                         
                             //$('#cover-'+hash).value(  newId);                      

                        } else console.log(xhr.statusText);
                    }
                });
        });


 /* Guardar Borrador */
    
    sendData();



 function sendData(){
  $('button[name="save"]').on('click',function(e) {           
    //alert('c');

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
    console.log('h');
                        if(xhr.status == 200) {
                            
                            console.log('200');               
                            newResponse = JSON.parse( xhr.response);
                            var slug = newResponse.slug;                                                         
                            $('#story-form').append('<input type="hidden" name="slug" value="'+slug+'" />');     
                            sendData();                                                    
                             //$('#cover-'+hash).value(  newId);                      

                        } else console.log(xhr.statusText);
                    }
                });

 });
 }

</script>
 @endpush