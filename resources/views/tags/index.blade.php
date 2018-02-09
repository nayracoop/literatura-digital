@extends('layouts.main')
@section('title') 
    @lang('page_titles.tags')
@endsection

@section('body_class') 
    class="white" 
@endsection

@section('content')

@php
    {{--  print_r($tags);  --}}
@endphp

@foreach($tags as $tag)

    {{ $tag->name }}
    
@endforeach
{{--  <div class="fondo-forms">
<div class="container listado-relatos">
    <div class="row">
        <div class="col-md-12">
            <h1>@lang('messages.tags_list')</h1>
            <hr />
            <table summary="@lang('messages.tags_list')">
                <caption class="invisibilizar">@lang('messages.users_list')</caption>
                <thead>
                    <tr>
                        <th class="ocultar-lg" scope="col">
                            <span class="invisibilizar">Imagen</span>
                        </th>
                        <th scope="col">
                            <a href="#">@lang('messages.user')</a>
                        </th>
                        <th scope="col" class="ocultar-sm ordenar">
                            <a href="#">@lang('messages.created_at')</a>
                        </th>
                        <th class="ocultar-lg" scope="col">
                            <a href="#">@lang('messages.role')</a>
                        </th>
                        <th scope="col" class="ocultar-sm">
                            <a href="#">@lang('messages.first_name')</a>
                        </th>
                        <th scope="col">
                            <span class="invisibilizar">Editar</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        @include('users.row')
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('admin.user.create') }}">
                <button class="btn btn-nuevo-relato">
                    <span>@lang('messages.new_user')</span>
                    <span class="plus"></span>
                </button>
            </a>
        </div>
    </div>  --}}
@endsection
    