@auth
    @php
        $user = auth()->user();
    @endphp
    @if($user->role == \App\Models\UserType::AUTHOR)
        <li><a href="{{  route('author.stories') }}">@lang('Mis Relatos')</a></li>
        <li><a href="{{  route('story.create') }}">@lang('Crear Relato')</a></li>
    @elseif($user->role == \App\Models\UserType::MOD)
        <li><a href="{{  route('story.create') }}">MODERAR</a></li>
    @elseif($user->role == \App\Models\UserType::ADMIN)
        <li><a href="{{  route('admin.list-users') }}">USUARIOS</a></li>
    @endif
    </ul>

    <ul class="nav navbar-nav login">
        <li>
            <a data-toggle="modal" href="{{ route('author.edit') }}">{{ $user->getName() }}</a>
        </li>
        <li>
            <a data-toggle="modal" href="{{ route('salir') }}">Salir</a>
        </li>
    </ul>
@endauth

@guest
    </ul>
    <ul class="nav navbar-nav login">  
        <li>
            <a data-toggle="modal" href="#ingresar">
                <span>Ingresar</a>
            </span>
        </li>
        <li>
            <a data-toggle="modal" href="#registrarse">
                <span>Registrarse</a>
            </span>
        </li>
    </ul>
@endguest
