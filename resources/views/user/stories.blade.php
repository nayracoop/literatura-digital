@extends('layouts.main')
@section('title') @lang('Buscar Relatos') @endsection
@section('body_class') class="white" @endsection
@section('content')

<div class="fondo-forms">
<div class="container listado-relatos">
  <div class="row">         
    <div class="col-md-12">

        <h1>Listado de relatos</h1>
        <hr />
          
        <table summary="Lista de relatos del usuario">
        <caption class="invisibilizar">Lista de relatos del usuario</caption>
        <thead>
          <tr>
            <th class="ocultar-lg" scope="col"><span class="invisibilizar">Imagen</span></th>
            <th scope="col"><a href="#">Nombre</a></th>
            <th scope="col" class="ocultar-sm ordenar"><a href="#">Fecha</a></th>
            <th class="ocultar-lg" scope="col"><a href="#">Caracteres</a></th>
            <th scope="col"  class="ocultar-sm"><a href="#">Estado</a></th>
            <th scope="col" class="ocultar-sm"><a href="#">Favoritos</a></th>
            <th scope="col"><span class="invisibilizar">Editar</span></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="ocultar-lg"><div class="image-clip"><img src="img/img-2.jpg" alt="" /></div></td>
            <td class="tit-listado">Do Androids Dream of Electric Sheep?</td>
            <td class="ocultar-sm">14.10.2017</td>
            <td class="ocultar-lg">2000</td>
            <td class="ocultar-sm">Publicado</td>
            <td class="ocultar-sm">20</td>
            <td><button>Editar</button></td>
          </tr>
          <tr>
            <td class="ocultar-lg"><div class="image-clip"><img src="img/img-1.jpg" alt="" /></div></td>
            <td class="tit-listado">The Hitchhiker's Guide to the Universe</td>
            <td class="ocultar-sm">14.10.2017</td>
            <td class="ocultar-lg">2000</td>
            <td class="ocultar-sm">Publicado</td>
            <td class="ocultar-sm">20</td>
            <td><button>Editar</button></td>
          </tr>
          <tr>
            <td class="ocultar-lg"><div class="image-clip"><img src="img/img-3.jpg" alt="" /></div></td>
            <td class="tit-listado">Something Wicked This Way</td>
            <td class="ocultar-sm">14.10.2017</td>
            <td class="ocultar-lg">2000</td>
            <td class="ocultar-sm">Publicado</td>
            <td class="ocultar-sm">20</td>
            <td><button>Editar</button></td>
          </tr>
        </tbody>
        </table>

        <button class="btn btn-nuevo-relato"><span>Nuevo relato</span><span class="plus"></span></button>

    </div>
  </div>
</div>
</div> 
@endsection

@push('javascript')
<script>
//formElement = document.getElementById("stories_search");
$('stories_search').on('submit',function(e){
  e.preventDefault();
});
$('input[name="search"]').bind('input',function(){
  console.log('gato');
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