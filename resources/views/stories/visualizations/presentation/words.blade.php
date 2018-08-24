@if(\Route::currentRouteName() === 'story.show')
@include('snippets.visualizations.words-show')

@elseif(\Route::currentRouteName() === 'nodes.index')
@include('snippets.visualizations.words-edit')

@endif

@push('javascript')
@include('stories.scripts.node-options')
@endpush
