@extends('layouts.main')

@section('title')
    @lang('Inicio')
@endsection

@section('content')
    @include('stories.typologies.description.' . $typology)
@endsection
