@if(\Route::currentRouteName() === 'story.show')
@include('snippets.visualizations.ergodic-show')

@elseif(\Route::currentRouteName() === 'nodes.index')
@include('snippets.visualizations.ergodic-edit')

@endif

@push('javascript')
<script src="{{asset('js/bootstrap.min.js')}}"></script>
@include('stories.scripts.node-options')
@include('snippets.visualizations.ergodic-scripts')
@endpush
