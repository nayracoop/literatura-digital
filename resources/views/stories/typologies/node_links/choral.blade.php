@php
$prev = $story->textNodes->where('order','<', $textNode->order)->sortByDesc('order')->first();
$next = $story->textNodes->where('order','>', $textNode->order)->sortBy('order')->first();
@endphp 

@if( $prev !== null )
<a href="{{ route('node.show',[ $story->slug , $prev->slug ]) }}">Anterior: {{$prev->title}}</a>  
@endif             

@if( $next !== null )
<a  href="{{ route('node.show',[ $story->slug , $next->slug ]) }}">| Siguiente: {{$next->title}}</a>  
@endif 