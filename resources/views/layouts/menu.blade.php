 <nav class="navbar navbar-top navbar-lexia" role="navigation">
    <div class="container">
      <div class="padding-container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-escrituras-collapse">
            <span class="sr-only">Desplegar navegación</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ route('index') }}"><span class="invisible">@lang('Lexía')</span></a>
        </div>
        <div class="collapse navbar-collapse navbar-escrituras-collapse">
          <ul class="nav navbar-nav">
            <li><a href="#about">@lang('Escribir')</a></li>
            <li class="active"><a href="{{ route('stories') }}">@lang('Relatos')</a></li>
            <li><a href="#contact">@lang('Contacto')</a></li>
             @include('author.main_menu')
          </ul>
          <ul class="nav navbar-nav pull-right login">
            @if( Auth::check() )
        <li><a data-toggle="modal" href="{{ route('author.edit') }}">{{auth()->user()->getName() }}</a></li>
        <li><a data-toggle="modal" href="{{ route('salir') }}">Salir</a></li>
        @else
          <li><a data-toggle="modal" href="#registrarse"><span class="invis">@lang('Registrarse')</a></span></li>
        @endif
            
          </ul>
        </div>
      </div>
    </div>
  </nav>
@include('snippets.register_form')
@include('snippets.login_form')  

