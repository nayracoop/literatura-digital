@extends('layouts.main')
{{--visualizacion vista publica --}}
@section('title')
  {{ $story->title }} @lang('de') {{ $story->getAuthorName() }}
@endsection

@section('content')
  @include('stories.typologies.node_presentation.'. $story->typology )
  @include('snippets.comments.story')

@endsection
