@if( Auth::check() && Auth::user()->role === 'author' )
        <li><a href="{{  route('author.stories') }}">@lang('Mis Relatos')</a></li>      
        <li><a href="{{  route('story.create') }}">@lang('Crear Relato')</a></li>        
@endif