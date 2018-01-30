@auth
        @php
            $user = auth()->user();
        @endphp
        @if($user->role == \App\Models\Enums\UserType::AUTHOR)
            <li class="{{ \App\Utils\MenuHelper::isActiveRoute('contact') }}"><a href="{{ route('contact') }}">@lang('menu.contact')</a></li>
            <li class="{{ \App\Utils\MenuHelper::isActiveRoute('my-stories') }}"><a href="{{ route('my-stories') }}">@lang('menu.my_stories')</a></li>
            <li class="{{ \App\Utils\MenuHelper::isActiveRoute('story.create') }}"><a href="{{ route('story.create') }}">@lang('menu.create_story')</a></li>
        @elseif($user->role == \App\Models\Enums\UserType::MOD)
            <li class="{{ \App\Utils\MenuHelper::isActiveRoute('admin.labels') }}"><a href="{{ route('admin.labels') }}">@lang('menu.labels')</a></li>
        @elseif($user->role == \App\Models\Enums\UserType::ADMIN)
            <li class="{{ \App\Utils\MenuHelper::isActiveRoute('admin.labels') }}"><a href="{{ route('admin.labels') }}">@lang('menu.labels')</a></li>
            <li class="{{ \App\Utils\MenuHelper::isActiveRoute('admin.list-users') }}"><a href="{{ route('admin.list-users') }}">@lang('menu.users')</a></li>
            <li class="{{ \App\Utils\MenuHelper::isActiveRoute('admin.categories') }}"><a href="{{ route('admin.categories') }}">@lang('menu.categories')</a></li>
        @endif
    </ul>

    <ul class="nav navbar-nav login logged">
        <li class="{{ \App\Utils\MenuHelper::isActiveRoute('author.edit') }}">
            <a data-toggle="modal" href="{{ route('author.edit') }}">{{ $user->getName() }}</a>
        </li>
        <li class="{{ \App\Utils\MenuHelper::isActiveRoute('salir') }}">
            <a data-toggle="modal" href="{{ route('salir') }}">@lang('menu.exit')</a>
        </li>
    </ul>
@endauth

@guest
    <li class="{{ \App\Utils\MenuHelper::isActiveRoute('contact') }}"><a href="{{ route('contact') }}">@lang('menu.contact')</a></li>
    </ul>
    <ul class="nav navbar-nav login">
        <li>
            <a data-toggle="modal" href="#ingresar">
                <span>@lang('menu.login')</a>
            </span>
        </li>
        <li>
            <a data-toggle="modal" href="#registrarse">
                <span>@lang('menu.register')</span>
            </a>
        </li>
    </ul>
@endguest
