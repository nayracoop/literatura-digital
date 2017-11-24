
<h2 class="tit-home">Favoritos</h2>
<hr />
<div class="row">
  <!-- BLOQUE -->
  @forelse($stories as $story) 
	
    @include('stories.summary') 

  @empty
    No hay resultados
  @endforelse
  <!-- BLOQUE -->
</div>
