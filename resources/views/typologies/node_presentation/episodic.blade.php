 @foreach( $story->textNodes->sortBy('order') as $textNode )
                  <li><h3><a href="{{ route('node.show', [$story->slug, $textNode->slug] ) }}">{{ $textNode->title }} | {{ $textNode->order }}</a></h3>
                  </li>                  
@endforeach