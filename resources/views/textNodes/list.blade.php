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
                    <td class="ocultar-sm">{{ $node->status }}</td>
                    <td>
                        <a href="{{ route('node.edit', [$story->id, $node->id]) }}">
                            <button>Editar</button>
                    </td>
                </tr>
                @endforeach
              </tbody>
              </table>

              <a href="{{route('node.create', $story->_id)}}"><button class="btn btn-nuevo-relato"><span>{{__('messages.add_node')}}</span><span class="plus"></span></button></a>
            </div>
                <div class="botones-nav-form">
                    <a href="{{ route('stories.list') }}" class="bot ant">{{__('messages.back_my_stories')}}</a>
                    <a href="{{ route('story.update', $story->id) }}" class="bot sig">{{__('messages.go_story_details')}}</a>
                </div>

            </div>
        </div>
    </div>
</div>
@include('textNodes.backdrop')
@include('textNodes.editModal')
@endsection

@push('javascript')
<script>
$('.edit').click(function(e) {
		e.preventDefault();
		var nodeId = $(this).data('edit-node');
		//var node = $('#ventana-nodo-'+id);

		//console.log( 'id '+ id);
		//console.log( 'modadl id '+ node.attr('id'));
		console.log( 'NODO-- '+ nodeId);
		var formData = new FormData();
		formData.append('id', nodeId);
		var xhttp = new XMLHttpRequest();
    xhttp.open('GET','{{route('node.json',$story->_id)}}');
    xhttp.setRequestHeader('X-XSRF-TOKEN', '{{csrf_token()}}');
		xhttp.send(formData);

		xhttp.addEventListener("readystatechange", function (e) {
			var xhr = e.target;
			if (xhr.readyState == 4) {
				//  console.log('h');
					if (xhr.status == 200) {

							console.log('200');
							newResponse = JSON.parse(xhr.response);
							//var results = newResponse.results;

              console.log(newResponse.node);

						//  $('.items-listado').empty();
						//  $('.items-listado').append(results);
					} else console.log(xhr.statusText);
			}
		});

  });
</script>
@endpush
