{{--  <div id="stories_block_list">
    <h2 class="tit-home" id="list_title">{{ $title }}</h2>
    <hr />
    <div class="row">
        @forelse($stories as $story)
            @include('stories.block_summary')
            @empty
                No hay resultados
        @endforelse
    </div>
</div>  --}}

<div class="row">
    <div class="col-sm-12">
        <div class="row">
            @forelse($stories as $story)
                @include('stories.block_summary')
                @empty
                    <div class="aviso">No se produjeron resultados</div>
            @endforelse
        </div>
    </div>
</div>
@include('stories.scripts.publish')
