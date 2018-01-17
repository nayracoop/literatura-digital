<div class="row">
    @forelse($stories as $story)        
        @include('stories.summary')
        @empty
            No hay resultados
    @endforelse
</div>
