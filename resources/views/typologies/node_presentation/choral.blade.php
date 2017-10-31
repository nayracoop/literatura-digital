 @foreach( $story->textNodes->sortByDesc('voice') as $textNode )
    <li><h3><a href="{{ route('node.show', [$story->slug, $textNode->slug] ) }}">{{ $textNode->title }} | voz: {{ $textNode->voice }} |{{ $textNode->order }}</a></h3></li>                  
@endforeach