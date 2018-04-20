@php
$node = $story->firstNode();
@endphp
<div class="fondo-forms">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        @include('snippets.stories.data-node')
        <div class="ergodic-node">
        </div>
<!--
      <a class="back-button back-button-ergodico" href="#">Volver</a>
-->
      @include('snippets.like')
      </div>
    </div>
  </div>
</div>
