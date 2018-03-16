@extends('layouts.main')

@section('title') @lang('Inicio') @endsection
@section('body_class') class="home" @endsection
@section('navbar-home-class') navbar-home @endsection

@section('content')
    <div class="container-fluid">
        <div class="destacado-home">  
        <div class="container">
            <div class="row">         
            <div class="col-md-8">
                <h1>¡<span class="brush">Elegí</span> el <br /> formato <span class="brush">ideal</span><br /> para tu his<span class="white">toria!</span></h1>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="container-fluid cards-home">
        <div class="container">
        <div class="row"> 
            <div class="col-sm-12">    
            <div class="row">

                <article class="col-sm-12 col-md-6">
                <div class="card"> 
                    <a href="{{ route('typology.description', 'episodic' ) }}">
                    <img src="{{ asset('img/home/icono-episodico.png') }}" alt="" />
                    <h3>Episódico</h3>
                    <span><hr /></span>
                    <p class="resumen">¿Qué pasaría si un relato tuviera la posibilidad de leerse de distintas maneras?</p>
                    <p class="ver-mas">conocé más</p>
                    </a>
                </div>  
                </article>

                <article class="col-sm-12 col-md-6">
                <div class="card"> 
                    <a href="#">
                    <img src="{{ asset('img/home/icono-coral.png') }}" alt="" />
                    <h3>Coral</h3>
                    <span><hr /></span>
                    <p class="resumen">¿Te encantan esas películas donde distintos personajes construyen un relato final? ¡Probá con este formato!</p>
                    <p class="ver-mas">conocé más</p>
                    </a>
                </div>  
                </article>

                <article class="col-sm-12 col-md-6">
                <div class="card"> 
                    <a href="#">
                    <img src="{{ asset('img/home/icono-ergodico.png') }}" alt="" />
                    <h3>Ergódico</h3>
                    <span><hr /></span>
                    <p class="resumen">¿Te gustan las aventuras gráficas? ¿Te fascinan los "Elije tu propia aventura? ¡Entonces este formato es para vos!</p>
                    <p class="ver-mas">conocé más</p>
                    </a>
                </div>  
                </article>

                <article class="col-sm-12 col-md-6">
                <div class="card"> 
                    <a href="#">
                    <img src="{{ asset('img/home/icono-temporal.png') }}" alt="" />
                    <h3>Temporal</h3>
                    <span><hr /></span>
                    <p class="resumen">¡Probá escribir un poco todos los días y descubrí si tenés pasta de escritor!</p>
                    <p class="ver-mas">conocé más</p>
                    </a>
                </div>  
                </article>

            </div>
            </div>
        </div>
        </div>
    </div>
    {{--  <div class="container-fluid fondo-gris">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="tit-home" id="list_title">@lang('messages.favorites')</h2>
                    <hr />
                    @include('stories.block_list')
                </div>
            </div>
        </div>
    </div>    --}}
@endsection


{{--  @push('javascript')
esto pasa a estar en la lista de historias
    <script>
        function hashChangedUpdate() {
            $(".status_switch:checkbox").on("click", changeStatus);

            function changeStatus(event) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        var response = JSON.parse(xhttp.response);
                        //console.log(response.results);
                    } else {
                        //console.log(xhttp.statusText);
                    }
                };
                xhttp.open("POST", "{{ route('story.change-status') }}", true);
                xhttp.setRequestHeader('X-CSRF-Token', "{{ csrf_token() }}");
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("id=" + event.target.id);
            }
        }
    </script>
@endpush  --}}
