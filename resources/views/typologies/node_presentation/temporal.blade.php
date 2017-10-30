 @foreach( $story->textNodes->sortBy('published_at') as $textNode )
                  <li><h3><a href="{{ route('node.show', [$story->slug, $textNode->slug] ) }}">{{ $textNode->title }} | {{ $textNode->published_at }}</a></h3></li>
                  
@endforeach