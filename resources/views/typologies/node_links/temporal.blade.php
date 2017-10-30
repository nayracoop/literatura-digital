@php

$prev = $story->textNodes->where('published_at','<', $textNode->published_at)->sortByDesc('published_at')->first();

$next = $story->textNodes->where('published_at','>', $textNode->published_at)->sortBy('published_at')->first();
@endphp 

@if( $prev !== null )
<a  href="{{ route('node.show',[ $story->slug , $prev->slug ]) }}">Anterior: {{$prev->title}}</a>  
@endif             

@if( $next !== null )
<a  href="{{ route('node.show',[ $story->slug , $next->slug ]) }}">| Siguiente: {{$next->title}}</a>  
@endif 