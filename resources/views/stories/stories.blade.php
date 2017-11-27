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
              <form  id="stories_search" >
                <label for="search" class="sr-only">Buscar:</label>
                <input type="text" name="search" placeholder="Buscar relatos">
              </form>
            </div>  
    @include('snippets.featured_stories')    
</div></div></div>
</div></div>
 
@endsection

@push('javascript')
<script>
//formElement = document.getElementById("stories_search");
$('stories_search').on('submit',function(e){
  e.preventDefault();
});
$('input[name="search"]').bind('input',function(){
 
  formElement = document.getElementById("stories_search");

  var xhr = new XMLHttpRequest();   
    var formData = new FormData( formElement ); 
  
    formData.append('_token', '{{ csrf_token() }}');
    console.log(formData);   
   // formData.append('_method', 'PATCH');             
    xhr.open("POST", '{{ route( 'stories.search') }}');
    xhr.send(formData);
    
    xhr.addEventListener("readystatechange", function(e) {
                    var xhr = e.target;
                    if (xhr.readyState == 4) {
  //  console.log('h');
                        if(xhr.status == 200) {
                            
                            console.log('200');               
                            newResponse = JSON.parse( xhr.response);
                            var results = newResponse.results;                                                                                   
                            $('.items-listado').empty(); 
                            $('.items-listado').append(results);
                        } else console.log(xhr.statusText);
                    }
    });

});

</script>
@endpush