@extends('layouts.main')
@section('title') @lang('Buscar Relatos') @endsection
@section('body_class') class="white" @endsection
@section('content')


<div class="container-fluid">
    <div class="row">   
      <div class="encabezado-categoria">      
        <div class="container">
          <div class="row">         
            <div class="col-md-12">
              <h1>Vampiros</h1>
              <div class="container-tags">
                <p><a href="#">#gente</a></p>
                <p><a href="#">#sangre</a></p>
                <p><a href="#">#computadoras</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="buscador">
      <div class="container">        
        <div class="row">
          <div class="col-md-12">
            <form>
              <input type="text" placeholder="Buscar relatos" />
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid fondo-gris">
    <div class="container">
      <div class="row"> 
        <div class="col-sm-12">    
          <div class="row">

        @forelse($stories as $story) 
	
        @include('stories.summary') 

        @empty
          No hay resultados
        @endforelse

            <article class="col-sm-12 col-md-6">
              <div class="card"> 
                <a href="#">
                  <img src="img/img-3.jpg" alt="" />
                  <h3>Do androids Dream of Electric Sheep?</h3>
                  <p class="autor-relato">Philip K. Dick</p>
                  <span><hr /></span>
                  <p class="resumen bloque-elipsis">Chica hermosa su vida llena de misterios. la manera en la que piensa es diferente, Ella no cree en la muerte ni en el amor la muerte ni en el amor la muerte ni en el amor</p>
                  <span class="ver-mas"></span>
                </a>
              </div>  
            </article>

            <article class="col-sm-12 col-md-6">
              <div class="card"> 
                <a href="#">
                  <img src="img/img-2.jpg" alt="" />
                  <h3>The Hitchhiker's Guide to the Universe</h3>
                  <p class="autor-relato">Philip K. Dick</p>
                  <span><hr /></span>
                  <p class="resumen bloque-elipsis">El gobierno decía que había creado al ser humano perfecto, al soldado invencible invencible  invencible</p>
                  <span class="ver-mas"></span>
                </a>
              </div>  
            </article>

            <article class="col-sm-12 col-md-6">
              <div class="card"> 
                <a href="#">
                  <img src="img/img-1.jpg" alt="" />
                  <h3>Do androids Dream of Electric Sheep?</h3>
                  <p class="autor-relato">Philip K. Dick</p>
                  <span><hr /></span>
                  <p class="resumen bloque-elipsis">Chica hermosa su vida llena de misterios. la manera en la que piensa es diferente, Ella no cree en la muerte ni en el amor la muerte ni en el amor la muerte ni en el amor</p>
                  <span class="ver-mas"></span>
                </a>
              </div>  
            </article>

            <article class="col-sm-12 col-md-6">
              <div class="card"> 
                <a href="#">
                  <img src="img/img-4.jpg" alt="" />
                  <h3>The Hitchhiker's Guide to the Universe</h3>
                  <p class="autor-relato">Philip K. Dick</p>
                  <span><hr /></span>
                  <p class="resumen bloque-elipsis">El gobierno decía que había creado al ser humano perfecto, al soldado invencible invencible  invencible</p>
                  <span class="ver-mas"></span>
                </a>
              </div>  
            </article>

          </div>
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