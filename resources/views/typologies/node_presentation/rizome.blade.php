 @foreach( $story->textNodes as $textNode )
                  <li><h3><a href="{{ route('node.show', [$story->slug, $textNode->slug] ) }}">{{ $textNode->title }}</a></h3></li>
                  
@endforeach