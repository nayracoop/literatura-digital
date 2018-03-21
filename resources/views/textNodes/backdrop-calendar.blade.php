<div class="nodo-backdrop-fondo esconder">
  @foreach( $story->textNodesByDate() as $date =>  $nodes )
  <div class="nodo-backdrop" id="ventana-nodo-{{ $node->_id }}" tabindex="-1" role="dialog" aria-labelledby="tit-nodo" aria-hidden="true">

        <a class="back-button cerrar-nodo close-arrow" data-node="{{$node->_id}}"  href="#">Volver</a>

        <div class="nodo-data-relato">
          <a href="#" class="cerrar-nodo">
            <div class="image-clip">
              <img src="img/img-2.jpg" alt="" />
            </div>
            <p class="tit-relato">Do androids dream of electric sheep?</p>
            <p class="autor-relato">Mike Wilson</p>
          </a>
        </div>

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

        <a class="back-button back-button-bottom cerrar-nodo" data-node="{{$node->_id}}" href="#">Volver</a>

  </div>
  @endforeach
</div>
