@php
$node = $story->firstNode();
@endphp
<div class="fondo-forms">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        @include('snippets.stories.data-node')

        <div class="titulo-nodo">
          <h1 id="tit-nodo">{!!$node->title!!}</h1>
          <span class="acento"><span></span></span>
        </div>

        <div class="container-nodo">{!!$node->text!!}</div>

      <ul class="container-nodo condicionales-ergodico">
        
        <li><a href="#" data-nextNode="" >Si salís de tu escondite</a></li>
        <li><a href="#" data-nextNode="" >Si le preguntás a dónde va</a></li>
      </ul>
<!--
      <a class="back-button back-button-ergodico" href="#">Volver</a>
-->
      <a href="#" class="btn-social">Compartir</a>
      <a href="#" class="btn-social">Me gusta</a>

      </div>
    </div>
  </div>
</div>
