<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-escrituras-collapse">
          <span class="sr-only">@lang('Desplegar navegación')</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

      <a class="navbar-brand" href="{{ route('index') }}">@lang('Escrituras digitales')</a>
    </div>
    <div class="collapse navbar-collapse navbar-escrituras-collapse">
      <ul class="nav navbar-nav">
        <li><a href="#about">@lang('messages.about_menu')</a></li>
        <li><a href="#services">@lang('Relatos')</a></li>
        <li><a href="#contacto">@lang('Contacto')</a></li>
        @if( Auth::check() )
        <li><a href="{{  route('story.create') }}">@lang('Crear Relato')</a></li>
        @endif
      </ul>
      <ul class="nav navbar-nav pull-right">
        @if( Auth::check() )
        <li><a data-toggle="modal" href="{{ route('author.edit') }}">{{auth()->user()->getName() }}</a></li>
        <li><a data-toggle="modal" href="{{ route('salir') }}">Salir</a></li>
        @else
        <li><a data-toggle="modal" href="#ingresar">@lang('Ingresar')</a></li>
        <li><a data-toggle="modal" href="#registrarse">@lang('Registrarse')</a></li>
        @endif

      </ul>
    </div>
  </div>
</nav>
@include('snippets.login_form')
@include('snippets.register_form')
  

