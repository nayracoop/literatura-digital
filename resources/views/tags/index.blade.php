@extends('layouts.main')
@section('title') 
    @lang('page_titles.tags')
@endsection

@section('body_class') 
    class="white" 
@endsection

@section('content')

<div class="fondo-forms">
<div class="container listado-relatos">
    <div class="row">
        <div class="col-md-6">
            <h1>@lang('messages.tags_list')</h1>
            <hr />
            <table summary="@lang('messages.tags_list')" class="tags_list">
                <caption class="invisibilizar">@lang('messages.tags_list')</caption>
                <thead>
                    <tr>
                        <th class="ocultar-lg" scope="col">
                            <span class="invisibilizar">Empty</span>
                        </th>
                        <th scope="col">
                            <a href="#">@lang('messages.tag')</a>
                        </th>
                        <th scope="col" class="ordenar">
                            <a href="#">@lang('messages.created_at')</a>
                        </th>
                        <th scope="col">
                            <span class="invisibilizar">Eliminar</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tags as $tag)
                        <tr>
                            <td></td>
                            <td class="tit-listado">{{ $tag->name }}</td>
                            <td class="ocultar-sm text-left">{{ date('d.m.Y', strtotime($tag->created_at) ) }}</td>
                            <td>
                                <a class="tag_delete" id="{{ $tag->_id }}" href="{{ route('tag.toggleDeleted', $tag->id) }}">
                                    <button class="{{ $tag->trashed() ? '' : 'active' }}">
                                    </button>
                                </a>
                            </td>                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('javascript')
<script>
    $(document).ready(function(){
        $('.tag_delete').on('click', (event) => {
            event.preventDefault();
            tagToggleDelete(event.currentTarget);
        });
    });

    function tagToggleDelete(el) {
        $el = $(el);
        let method = 'PATCH';
        let uri = $el.attr('href');

        let xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                let response = JSON.parse(xhttp.response);
                if(response.status === 'ok') {
                    $el.children('button').toggleClass('active');                
                }
            } else {
            }
        };

        //esto necesita una barra al final para pasar el id
        xhttp.open(method, uri + "/", true);
        xhttp.setRequestHeader('X-CSRF-Token', "{{ csrf_token() }}");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //necesito este encabezado para que Symfony lo agarre con el Request::ajax() 
        xhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        xhttp.send(null);
    }
</script>
@endpush
    