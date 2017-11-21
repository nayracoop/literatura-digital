
  <div class="items-listado">
  <!-- BLOQUE -->
  @forelse($stories as $story) 
	
    @include('stories.summary') 

  @empty
    No hay resultados
  @endforelse
  <!-- BLOQUE -->
 </div>

