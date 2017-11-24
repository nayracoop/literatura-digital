<div class="row">
  <!-- BLOQUE -->
  @forelse($stories as $story) 
	
    @include('stories.summary') 

  @empty
    No hay resultados
  @endforelse
  <!-- BLOQUE -->
</div>
