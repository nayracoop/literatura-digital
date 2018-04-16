@yield('visualization')
@if(\Route::currentRouteName() === 'story.show')
@include('textNodes.backdrop')
@endif
@push('stylesheets')
<link href="{{asset('css/visualizations.css')}}" rel="stylesheet">
<!-- <link href="{{asset('css/reset.css')}}" rel="stylesheet"> -->
@endpush
@push('javascript')
<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="https://d3js.org/d3-path.v1.min.js"></script>
<script src="https://d3js.org/d3-shape.v1.min.js"></script>
<script src="https://d3js.org/d3-random.v1.min.js"></script>
<script src="https://d3js.org/d3-selection-multi.v1.min.js"></script>
@yield('visualization_scripts')
@include('stories.scripts.node-options')
@endpush
