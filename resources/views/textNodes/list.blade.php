@extends('layouts.main')

@section('title')
@lang('Buscar Relatos')
@endsection

@section('body_class')
@endsection

@section('content')

<div class="fondo-forms editor-relato">
    <div class="container listado-relatos">
        <div class="row">
            
            @include('textNodes.visualizations.' . $story->visualization)

            <div id="modo-listado" class="tabpanel">
                <h1>Listado de nodos</h1>
                <hr />

                <table summary="Lista de nodos del relato">
                <caption class="invisibilizar">Lista de nodos del relato</caption>
                <thead>
                    <tr>
                    <th scope="col" class="ordenar"><a href="#">Orden</a></th>
                    <th scope="col"><a href="#">Nombre</a></th>
                    <th scope="col" class="ocultar-sm"><a href="#">Fecha</a></th>
                    <th class="ocultar-lg" scope="col"><a href="#">Caracteres</a></th>
                    <th scope="col"  class="ocultar-sm"><a href="#">Estado</a></th>
                    <th scope="col"><span class="invisibilizar">Editar</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($story->textNodes as $node)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td class="tit-listado">{{$node->title or '--'}}</td>
                        <td class="ocultar-sm">{{ date('d.m.Y', strtotime($node->created_at) ) }}</td>
                        <td class="ocultar-lg">{{ $node->charCount }}</td>
                        <td class="ocultar-sm">{{ ucfirst($node->status) }}</td>
                        <td>
                            <a href="{{ route('node.edit', [$story->id, $node->id]) }}">
                                <button>Editar</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>                
            </div>
            <a href="{{ route('node.create', $story->_id) }}"><button class="btn btn-nuevo-relato"><span>{{__('messages.add_node')}}</span><span class="plus"></span></button></a>
            <div class="botones-nav-form">
                <a href="{{ route('stories.list') }}" class="bot ant">{{__('messages.back_my_stories')}}</a>
                <a href="{{ route('story.update', $story->id) }}" class="bot sig">{{__('messages.go_story_details')}}</a>
            </div>
        </div>
    </div>
</div>
@include('textNodes.backdrop')
@include('textNodes.edit_modal')
@endsection

@push('javascript')
<script>
//$(document).ready(function(){
//});
</script>
@endpush
