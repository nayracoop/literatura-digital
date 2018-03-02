<nav class="navbar navbar-top navbar-lexia" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-escrituras-collapse">
                <span class="sr-only">@lang('display_navigation')</span>
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
                <li class="dropdown">
                    <a href="{{ route('stories') }}"
                        class="dropdown-toggle" type="button" 
                        id="dropdownMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                            @lang('menu.stories')
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="{{ route('stories.genre') }}">@lang('menu.genres_all')</a></li>
                        @foreach(\App\Models\Genre::all() as $genre)
                            <li><a class="dropdown-item" href="{{ route('stories.genre', $genre->slug) }}">{{ $genre->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                {{--  
                    Menú que arma los accesos para el tipo de usuario logueado
                    ojo que cierra el </ul> de arriba
                --}}
                @include('layouts.menu_user')
        </div>
    </div>
</nav>

@guest
    @include('auth.register')
    @include('auth.login')
@endguest

{{--  @push('javascript')
    <script>
        window.addEventListener("hashchange", function (e) {
            searchByGenre(location.hash);
        }, false);

        window.onload = function (e) {
            let hash = location.hash;
            if (hash != '') {
                // usamos el hash ingresar en Middlewares
                // para abrir el modal de login
                if (hash == '#ingresar') {
                    $('#link_login').click();
                } else {
                    searchByGenre(hash);
                }
            }
        }

        function searchByGenre(genre) {
            genre = genre.substring(1);
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {                    
                    var storiesList = JSON.parse(xhttp.response);
                    var el = document.getElementById("stories_block_list");
                    el.innerHTML= storiesList.results;
                    hashChangedUpdate();
                } else {
                    // console.log(xhttp.statusText);
                }
            };
            xhttp.open("POST", "{{ route('stories.search-by-genre') }}", true);
            xhttp.setRequestHeader('X-CSRF-Token', "{{ csrf_token() }}");
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("genre=" + genre);
        }
    </script>
@endpush  --}}