@if(\Route::currentRouteName() === 'story.show')
@include('snippets.visualizations.words-show')

@elseif(\Route::currentRouteName() === 'nodes.index')
@include('snippets.visualizations.words-edit')

@endif

@push('javascript')
<script src="{{asset('js/bootstrap.min.js')}}"></script>
  @include('stories.scripts.node-options')
@endpush
