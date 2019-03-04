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
                <h1><span class="resaltado">¡Elegí</span> el formato <span class="resaltado">ideal</span><br /> para tu <span class="resaltado">historia!</span></h1>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="container-fluid explicaciones-home">
        <div class="container">
        <div class="row">
            <div class="col-sm-12">
            <div class="row">

                <div class="fnd-intro">
                    <div class="texto-introduccion">
                        <h2>¿Qué es una lexía?</h2>
                        <p>Una lexía es la partícula mínima en la que se puede dividir un relato sin perder sentido. La primera frase de <strong>Rayuela</strong> de <i>Julio Cortázar</i> “¿Encontraría a la Maga?” es una lexía que implica un narrador en primera persona, introduce a un personaje (la Maga) y establece una relación entre ambos (el narrador ansía encontrarse casualmente con otro). En cambio el artículo “la” aislado significa poco. Una lexía puede ser tanto una oración simple, como uno o más párrafos enteros o pueden llegar a constituir un capítulo entero. Varias lexías ordenadas de cierta manera forman la estructura coherente de un relato.</p>

                        <p>Muchas de las narraciones que leemos o vemos en una pantalla tienen una estructura donde la acción se desarrolla de menor a mayor y los hechos se encadenan en relaciones causa-efecto. De acuerdo con este modelo, el libro <strong>Harry Potter y la piedra filosofal</strong> puede resumirse de la siguiente manera:</p>
                    </div>

                  <div class="pixar-pitch">
                    <span class="comillas-inicio"></span>
                    <span class="comillas-final"></span>
                    <p>Un chico llamado Harry Potter sufre el maltrato incesante de sus padres adoptivos. Un día descubre que tiene poderes mágicos. Por eso va al Colegio Hogwarts de Magia y Hechicería y aprende todo sobre el significado de ser mago. En el Colegio se entera del poder creciente del maléfico hechicero Lord Voldemort y su interés por obtener la Piedra Filosofal que se halla escondida en las profundidades del edificio. Ante la despreocupación de las autoridades del Colegio, Harry decide conseguir la Piedra antes que lo haga Voldemort y para eso deberá sortear una serie de pruebas. Sobre el final de la historia se revela si Harry logra su objetivo de proteger la Piedra o no.</p>
                    <img src="{{ asset('img/home/varita.svg') }}" alt="" />
                  </div>
              </div>
       
                <p class="intro-modelos">Generalmente este tipo de estructura es la que determina el orden y la interrelación entre las lexias. ¿Pero qué pasaría si pudiésemos jugar con ese orden y probáramos componer nuestros relato de una y mil maneras? La plataforma <strong class="tit-sitio">Lexias</strong> te invita a escribir un relato en base a cuatro modelos puntuales que aprovechan al máximo las posibilidades combinatorias de una lexía.</p>


                <div class="resumen resumen-episodico">
                    <div class="fnd-avatar-episodico"><img src="{{ asset('img/home/episodico.svg') }}" alt="" /></div>
                    <h2 class="tit-modo">Episódico</h2>
                    <p>El formato <strong>episódico</strong> tiene su origen en el modo antiguo en el que se ordenaban algunas novelas (como el Quijote de Cervantes) o los relatos orales largos. Una estructura en episodios se forma de una serie de capítulos más o menos independientes entre sí (no necesariamente hay una progresión en la acción o los personajes) que en conjunto funcionan de una manera que no está implícita en cada fragmento separado. Esto permite que un relato pueda ordenarse de muchas maneras de acuerdo con las necesidades específicas de un autor. Así la disposición de los episodios puede ser cronológica y estar en relación con la temporalidad de los acontecimientos que se relatan, puede estar basada en un sistema como el orden alfabético de los diccionario o los departamentos de un edificio y puede ser aún aleatoria y en ese caso el lector reconstruye el relato como si se tratara de un rompecabezas.</p>
                    <a href="{{ route('typology.description', 'episodic' ) }}" class="btn-resumen">Conocé más</a>
                </div>

                <div class="resumen resumen-coral">
                    <div class="fnd-avatar-coral"><img src="{{ asset('img/home/coral.svg') }}" alt="" /></div>
                    <h2 class="tit-modo">Coral</h2>
                    <p>En el formato <strong>coral</strong> el orden viene dado por el desarrollo paralelo de varios personajes. Muchas veces estos personajes de relacionan entre sí por un vínculo común (comparten un ámbito y por ejemplo viven en la misma ciudad), otras veces la estructura coral es útil para abordar un tema complejo que se puede explicar mejor a través de varios puntos de vista (el efecto del capitalismo global en un pueblo, el narcotráfico) y algunos ejemplos hacen un gran uso del formato coral para analizar una misma situación desde perspectivas bien diferentes.</p>
                    <a href="{{ route('typology.description', 'coral' ) }}" class="btn-resumen">Conocé más</a>
                </div>

                <div class="resumen resumen-ergodico">
                  <div class="fnd-avatar-ergodico"><img src="{{ asset('img/home/ergodico.svg') }}" alt="" /></div>
                    <h2 class="tit-modo">Ergódico</h2>
                    <p>El formato <strong>ergódico</strong> permite construir historias donde el lector tiene la posibilidad tomar decisiones sobre las acción que desarrollan los personajes y de esa manera modificar el curso del relato. Ergódico viene de las palabras griegas <i>ergon</i> (trabajo) y <i>hodos</i> (camino).</p>
                    <a href="{{ route('typology.description', 'ergodico' ) }}" class="btn-resumen">Conocé más</a>
                </div>

                <div class="resumen resumen-temporal">
                    <div class="fnd-avatar-temporal"><img src="{{ asset('img/home/temporal.svg') }}" alt="" /></div>
                    <h2 class="tit-modo">Temporal</h2>
                    <p>El <strong>temporal</strong> es un formato que aprovecha las posibiliades contenidas en el ejercicio de escribir un poco todos los días. Este orden te permite llevar un orden cronólogico al modo de un diario, o también te da la posibilidad de acumular  fragmentos que en algún momento te van a servir de arcilla para construir nuevos relatos.</p>
                    <a href="{{ route('typology.description', 'temporal' ) }}" class="btn-resumen">Conocé más</a>
                </div>  

            </div>
            </div>
        </div>
        </div>
    </div>
    <!--<div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="tit-home" id="list_title">@lang('messages.favorites')</h2>
                        <hr />
                        @include('stories.block_list')
                    </div>
                </div>
            </div>
        </div>-->
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
