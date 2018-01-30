<div class="row" id="stories_list">
    @forelse($stories as $story)        
        @include('stories.summary')
        @empty
            No hay resultados
    @endforelse
</div>
