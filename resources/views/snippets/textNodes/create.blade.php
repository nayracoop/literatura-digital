@if (Auth::check() && Auth::user()->role === 'author')
    <a href="{{ route('node.create', $story->slug) }}">@lang('Nuevo fragmento')</a>
@endif