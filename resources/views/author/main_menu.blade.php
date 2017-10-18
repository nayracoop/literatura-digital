@if( Auth::check() && Auth::user()->role === 'author' )
        <li><a href="{{  route('story.create') }}">@lang('Crear Relato')</a></li>        
@endif