<nav class="navbar navbar-top navbar-lexia" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-escrituras-collapse">
                <span class="sr-only">Desplegar navegación</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('index') }}">
                <span class="invisibilizar">Lexía</span>
            </a>
        </div>
        {{--  
            TODOS los usuarios tienen acceso a
            los géneros y al formulario de contacto
        --}}
        <div class="collapse navbar-collapse navbar-escrituras-collapse">
            <ul class="nav navbar-nav">
                <li class="active dropdown">
                    <a href="{{route('stories')}}" class="dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">Relatos</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach(\App\Models\Genre::all() as $genre)
                            <li>
                                <a class="dropdown-item" href="#{{ $genre->slug }}">{{ $genre->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="#contact">Contacto</a>
                </li>
                {{--  
                    Menú que arma los accesos para el tipo de usuario logueado
                    ojo que cierra el </ul> de arriba
                --}}
                @include('user.main_menu')
                
        </div>
    </div>
</nav>

@guest
    @include('snippets.register_form')
    @include('snippets.login_form')
@endguest

@push('javascript')
    <script>
        window.addEventListener("hashchange", function (e) {
            searchByGenre(location.hash);
        }, false);

        function searchByGenre(genre) {
            genre = genre.substring(1);
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    
                    newResponse = JSON.parse(xhttp.response);
                } else {

                    console.log(xhttp.statusText);
                }
            };
            xhttp.open("POST", "{{ route('searchByGenre') }}", true);
            xhttp.setRequestHeader('X-CSRF-Token', "{{ csrf_token() }}");
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("genre=" + genre);
        }
    </script>
@endpush