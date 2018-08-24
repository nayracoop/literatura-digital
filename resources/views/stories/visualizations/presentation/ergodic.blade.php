@if(\Route::currentRouteName() === 'story.show')
@include('snippets.visualizations.ergodic-show')

@elseif(\Route::currentRouteName() === 'nodes.index')
@include('snippets.visualizations.ergodic-edit')

@endif

@push('javascript')

@include('stories.scripts.node-options')
@include('snippets.visualizations.ergodic-scripts')
@endpush
