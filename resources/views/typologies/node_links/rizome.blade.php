@if( $textNode->nodes !== null )
              @foreach( $textNode->nodes as $node )    
              @php 	
              	$choice = $story->textNodes->where('_id',$node)->first();
              @endphp
             
             <a  href="{{ route('node.show',[ $story->slug , $choice->slug ]) }}" >{{ $choice->title }}</a>        
      
@endforeach
@endif
