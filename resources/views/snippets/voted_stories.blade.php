<div class="row">
  <div class="col-lg-12">
    <h3>@lang('Los más votados')</h3>
  </div>
</div>

<div class="row text-center">
  <!-- BLOQUE -->
  @foreach($stories as $story) 
	<div class="col-lg-3 col-sm-6">
    @include('stories.summary') 
	</div>
  @endforeach
  <!-- BLOQUE -->
</div>