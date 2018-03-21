<div class="nodo-backdrop-fondo esconder">
  @foreach( $nodesByDate as $date =>  $nodes )
  <div class="nodo-backdrop esconder" id="ventana-nodo-{{ $nodes[0]->_id }}" tabindex="-1" role="dialog" aria-labelledby="tit-nodo" aria-hidden="true">

        <a class="back-button cerrar-nodo close-arrow" data-node="{{$nodes[0]->_id}}"  href="#">{{__('messages.back')}}</a>

        @include('snippets.stories.data-node')

        <div class="container-nodo">

          <ul class="timeline-dia">
            @foreach( $nodes as $key => $node )
            <li>
              <p>{{ $date }}</p>
              <h2>{{ $node->title }}</h2>
              <p>{{ $node->text }}</p>
            </li>
            @endforeach
          </ul>

        </div>

        <a class="back-button back-button-bottom cerrar-nodo" data-node="{{$nodes[0]->_id}}" href="#">{{__('messages.back')}}</a>

  </div>
  @endforeach
</div>
