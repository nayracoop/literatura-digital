@extends('layouts.main')
{{--visualizacion vista publica --}}
@section('title')
  {{ $story->title }} @lang('de') {{ $story->getAuthorName() }}
@endsection

@section('content')
  @include('stories.typologies.node_presentation.'. $story->visualization )
  @include('snippets.comments.story')

@endsection
@push('javascript')
      @include('stories.scripts.node-options')
@endpush
