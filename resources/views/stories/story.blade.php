@extends('layouts.main')
@section('title') {{ $story->title }} @lang('de') {{ $story->getAuthorName() }}  @endsection  
@section('content')
    <div class="row">
      <div class="col-sm-12">
        <div class="padding-relato">
          <div class="relato">
            <div class="row">
              
              <div class="col-sm-3">
                <div class="media-relato">
                  @if(  $story->cover != null && !empty($story->cover)  )
                  <img alt="@lang('tapa de') {{$story->title}}" src="{{ asset('imagenes/cover/'.$story->cover )}}">        
                  @else
                  <img alt="" src="{{ asset('img/tapa200x200.png')}}"> 
                  @endif
                </div>
              </div>

              <div class="col-sm-9">
                  <h1>{{ $story->title }}</h1>@include('author.edit_story_title')
                  <p class="lead">@lang('De') <a href="{{ route('author.show', $story->author->slug) }}">{{ $story->getAuthorName() }}</a></p>
                  
                  <p><span class="glyphicon glyphicon-time"></span>@lang('Publicado') {{ $story->published_at }}</p>
                  
                @include('snippets.like')
                <ul class="relato-nodos">
                 @if( $story->textNodes->count() > 0 )
                    {{--  Separamos la presentación de nodos de acuerdo a la tipologia --}}
                    @include('typologies.node_presentation.'.$story->typology)
                    
                 @else
                  <div class="col-lg-4 col-md-6">@lang('No hay fragmentos')</div>
                 @endif  
                </ul>
                @include('author.new_node')
              </div>
            
            </div>

        <hr>
         @include('snippets.comments') 

      </div>
    </div>
</div>
</div>
@endsection

@push('javascript')
<script >

/* Guardar Borrador */    

$('.editable button').on('click',function(e) {      

    e.preventDefault();  
    var formElement = $(this).parent();    
    formElement = document.getElementById(formElement.attr('id') );
    var xhr = new XMLHttpRequest();   
    var formData = new FormData( formElement ); 
     
    formData.append('_token', '{{ csrf_token() }}');   
    formData.append('_method', 'PATCH');             
    xhr.open("POST", '{{ route( 'update-story', $story->slug ) }}');
    xhr.send(formData);
    
    xhr.addEventListener("readystatechange", function(e) {
                    var xhr = e.target;
                    if (xhr.readyState == 4) {
  //  console.log('h');
                        if(xhr.status == 200) {
                            
                            console.log('200');               
                            newResponse = JSON.parse( xhr.response);
                            var input = newResponse.input;                                                                                   
                            $('h1').text(input); 
                        } else console.log(xhr.statusText);
                    }
                });

 });
 

</script>
@endpush
