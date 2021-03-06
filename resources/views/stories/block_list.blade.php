<div class="row">
    <div class="col-sm-12">
        <div class="row">
          @forelse($stories as $story)
              @if( (Auth::check() && Auth::user()->isAdminOrMod() ) || (Auth::check() && Auth::user()->_id === $story->author_id) || $story->status === 'publicado')
                  @include('stories.block_summary')
              @endif
          @empty
              <div class="aviso">No se produjeron resultados</div>
          @endforelse
        </div>
    </div>
</div>
@include('stories.scripts.publish')
