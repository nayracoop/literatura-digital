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
        <div class="col-md-12">
            <div class="data-relato">
                <div class="image-clip">
                    @if($story->cover != null && !empty($story->cover))
                        <img alt="@lang('tapa de') {{$story->title}}" src="{{ asset('imagenes/cover/'.$story->cover )}}"> @else
                        <img alt="" src="{{ asset('img/img-2.jpg')}}">
                    @endif
                </div>
                <p class="tit-relato">{{ $story->title or ' --' }}</p>
                <p class="autor-relato">{{ $story->getAuthorName() }}</p>
            </div>

            <ul class="modos tabs" role="tablist">
                    <li class="active"><a href="#modo-visualizacion">Modo visualización</a></li>
                    <li><a href="#modo-listado">Modo listado de nodos</a></li>
            </ul>

            <div id="modo-visualizacion" class="tabpanel active">
                <div class="row" style="clear: both;">
                        <div class="col-sm-7 col-md-6 tit-editor-visual">
                            <h1>Visualización</h1>
                            <hr />
                        </div>
            </div>

            <div class="row formulario" style="clear: both;">
            <div class="col-md-12">

            <div class="container-nodo palabras">

                <h1>{{$story->title}}</h1>
                <p class="autor">{{$story->getAuthorName()}}</p>

                <ul>
                    @foreach($story->textNodes as $node)
                    <li><a>{{$node->title}}</a></li>
                    @endforeach
                </ul>

            </div>


            <div class="modal-opciones-nodo modal-left">
                <h2>El hacha</h2>
                <hr />
                <a href="#">Leer nodo</a>
                <a href="#">Editar nodo</a>
            </div>

            </div>

            </div>

            <div class="row formulario">

            <div class="col-md-3">
                <form role="form" class="opciones-visual">
                <label for="colores">Colores</label>
                <div class="styled-select">
                    <select type="text" class="form-control" id="colores">
                    <option value="amarillo">Amarillo</option>
                    <option value="celeste">Celeste</option>
                    <option value="naranja">Naranja</option>
                    <option value="verde">Verde</option>
                    <option value="rosa">Rosa</option>
                    </select>
                </div>

                </form>

                </div>

            </div>
            </div>
        </div>

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
                    </a>
                </td>
            </tr>
            @endforeach
            </tbody>
            </table>

            <a href="{{ route('node.create', $story->id) }}">
                <button class="btn btn-nuevo-relato">
                    <span>Agregar nodo</span>
                    <span class="plus"></span>
                </button>
            </a>
        </div>

            @include('stories.typologies.node_presentation.user.' . $story->typology)



            <div class="botones-nav-form">
                <a href="{{ route('stories.list') }}" class="bot ant">Volver a mis relatos</a>
                <a href="{{ route('story.update', $story->id) }}" class="bot sig">Ir a detalles del relato</a>
            </div>

        </div>
    </div>
</div>
</div>
@endsection @push('javascript')
<script src="{{asset('js/libs/jquery.min.js')}}"></script>
<script src="{{asset('js/libs/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/functions-general.js')}}"></script>

<script>

var posiciones = [ ['Animales', '20', '30'], ['Descanso', '10', '70'], ['Supersticiones','33','84'], ['Festejos', '5', '30'], ['Ventana', '4.23', '50'], ['Lluvia', '20', '80'], ['Leña', '50', '90'], ['Tradiciones', '50', '65'], ['Cielo', '80', '88'], [ 'Familia', '40', '66'], ['Interiores', '20', '40'], ['Reuniones', '56', '70'], ['Compañerismo', '28', '38'], ['Albañilería', '56', '45'], ['Cerveza', '88', '80'], ['Árboles', '26', '20'] ];
posiciones.color = 'verde';

var i=0;
$('.palabras a').each(function() {
    $(this).parent().css({ 'top': + posiciones[i][1] + '%', 'left':  + posiciones[i][2] + '%' })
    i++;
});

$('.palabras').addClass(posiciones.color);

    /***********/
    /* LIMITAR AREA PADDING */
    /***********/
if($(window).width() > 768){
    $('.palabras li').draggable({
        containment: ".palabras",
        stop: function() {
        var top = parseInt($(this).css('top')) - 29;
        var left = parseInt($(this).css('left')) - 21;


        if(($(window).width() < 992) && ($(window).width() > 768)){
            var top = parseInt($(this).css('top')) - 35;
            var left = parseInt($(this).css('left')) - 125;
        }

        $(".modal-opciones-nodo").css({ 'top': top , 'left': left });
        $(".modal-opciones-nodo").show();
        }
    });
}


$(".modal-opciones-nodo").mouseleave(function() {
    $(this).hide();
});


$('.opciones-visual').change(function(){
    $('.palabras').removeClass($('.palabras').attr('class').split(' ').pop());
    $('.palabras').addClass($('.opciones-visual select option:selected').attr('value'));
});

$(".autor").click(function() {

    var posicionesNuevo = [];
    var e = 0;
    $('.palabras a').each(function() {
        var top = parseInt($(this).parent().css('top')) * 100 / $('.palabras').height();
        var left = parseInt($(this).parent().css('left')) * 100 / $('.palabras').width();
        posicionesNuevo[e] = [];
        posicionesNuevo[e][0] = $(this).text();
        posicionesNuevo[e][1] = top;
        posicionesNuevo[e][2] = left;
        e++;
    });
    console.log(posicionesNuevo);
});


</script>
<script>
//formElement = document.getElementById("stories_search");
$('stories_search').on('submit', function (e) {
    e.preventDefault();
});
$('input[name="search"]').bind('input', function () {
    //console.log('gato');
    formElement = document.getElementById("stories_search");

    var xhr = new XMLHttpRequest();
    var formData = new FormData(formElement);

    formData.append('_token', '{{ csrf_token() }}');
    console.log(formData);
    // formData.append('_method', 'PATCH');
    xhr.open("POST", "{{ route( 'stories.search') }}");
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
