@extends('layouts.main')

@if (isset($story->author))
  @php $authorName = $story->getAuthorName(); @endphp
@else
  @php $authorName = __('messages.deleted_user'); @endphp
@endif

@section('title')
  {{ $story->title }} @lang('de') {{ $authorName }}
@endsection

@section('content')
  @include('stories.typologies.node_presentation.'. $story->visualization )
  @include('snippets.comments.story')

@endsection
@push('javascript')
      @include('stories.scripts.node-options')
@endpush
