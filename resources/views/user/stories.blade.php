@extends('layouts.main')

@section('title') 
    @lang('Buscar Relatos')
@endsection

@section('body_class') 
    class="white" 
@endsection

@section('content')
<div class="fondo-forms">
    <div class="container listado-relatos">
        <div class="row">
            <div class="col-md-12">
                <h1>Listado de relatos</h1>
                <hr />
                <table summary="Lista de relatos del usuario">
                    <caption class="invisibilizar">Lista de relatos del usuario</caption>
                    <thead>
                        <tr>
                            <th class="ocultar-lg" scope="col">
                                <span class="invisibilizar">Imagen</span>
                            </th>
                            <th scope="col">
                                <a href="#">Nombre</a>
                            </th>
                            <th scope="col" class="ocultar-sm ordenar">
                                <a href="#">Fecha</a>
                            </th>
                            <th class="ocultar-lg" scope="col">
                                <a href="#">Caracteres</a>
                            </th>
                            <th scope="col" class="ocultar-sm">
                                <a href="#">Estado</a>
                            </th>
                            <th scope="col" class="ocultar-sm">
                                <a href="#">Favoritos</a>
                            </th>
                            <th scope="col">
                                <span class="invisibilizar">Editar</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user->getStories() as $story)
                        <tr>
                            <td class="ocultar-lg">
                                <a href="{{route('story.nodes',$story->_id)}}">
                                    <div class="image-clip">
                                        @if($story->cover != null && !empty($story->cover))
                                            <img alt="@lang('tapa de') {{$story->title}}" src="{{ asset('imagenes/cover/'.$story->cover )}}"> 
                                        @else
                                            <img alt="" src="{{ asset('img/img-3.jpg')}}"> 
                                        @endif
                                    </div>
                                </a>
                            </td>
                            <td class="tit-listado">
                                <a href="{{route('story.nodes',$story->_id)}}">{{ $story->title }}</a>
                            </td>
                            <td class="ocultar-sm">{{ date('d.m.Y', strtotime($story->created_at) ) }}</td>
                            <td class="ocultar-lg">2000</td>
                            <td class="ocultar-sm">{{ $story->status }}</td>
                            <td class="ocultar-sm">{{ $story->likes->count() }}</td>
                            <td>
                                <a href="{{route('story.edit',$story->_id)}}">
                                    <button>Editar</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <a href="{{route('story.create')}}">
                    <button class="btn btn-nuevo-relato">
                        <span>Nuevo relato</span>
                        <span class="plus"></span>
                    </button>
                </a>

            </div>
        </div>
    </div>
</div>
@endsection 

@push('javascript')
<script>
    //formElement = document.getElementById("stories_search");
    $('stories_search').on('submit', function (e) {
        e.preventDefault();
    });
    $('input[name="search"]').bind('input', function () {
        console.log('gato');
        formElement = document.getElementById("stories_search");

        var xhr = new XMLHttpRequest();
        var formData = new FormData(formElement);

        formData.append('_token', '{{ csrf_token() }}');
        console.log(formData);
        // formData.append('_method', 'PATCH');
        xhr.open("POST", "{{ route('stories.search') }}");
        xhr.send(formData);

        xhr.addEventListener("readystatechange", function (e) {
            var xhr = e.target;
            if (xhr.readyState == 4) {
                //  console.log('h');
                if (xhr.status == 200) {

                    console.log('200');
                    newResponse = JSON.parse(xhr.response);
                    var results = newResponse.results;
                    $('.items-listado').empty();
                    $('.items-listado').append(results);
                } else console.log(xhr.statusText);
            }
        });
    });
</script>
@endpush
