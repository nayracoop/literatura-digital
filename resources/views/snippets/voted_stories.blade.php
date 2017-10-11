<div class="row">
  <div class="col-lg-12">
    <h3>Los más votados</h3>
  </div>
</div>

<div class="row text-center">
  <!-- BLOQUE -->
  @foreach($stories as $story) 
    @include('stories.summary') 
  @endforeach
  <!-- BLOQUE -->
</div>