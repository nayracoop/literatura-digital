<div class="col-md-12">
    @include('snippets.stories.data')
    @include('snippets.textNodes.modes_tabs')


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
         <li  data-node="{{$node->id}}"><a >{{$node->title}}</a></li>
         @endforeach
       </ul>
   </div>


    <div class="modal-opciones-nodo modal-left">
      <h2>---</h2>
      <hr />
      <a href="#" class="leer">Leer nodo</a>
      <a href="#" class="edit" data-edit-node="">Editar nodo</a>
    </div>

    </div>

    </div>

    <div class="row formulario">

    <div class="col-md-3">
      <form role="form" class="opciones-visual">
        <label for="colores">Colores</label>
        <div class="styled-select">
          <select type="text" class="form-control" id="colores">
          @foreach( \App\Models\Enums\WordColor::values() as $key => $color )
            <option value="{{strtolower($color)}}" @if( strtolower($color) == $story->color) selected @endif >{{$color}}</option>
          @endforeach
          </select>
        </div>

      </form>

      </div>

    </div>
  </div>
</div>


@push('javascript')

<script src="{{asset('js/libs/jquery-ui.min.js')}}"></script>



<script>
  //  var posiciones = [ ['Animales', '20', '30'], ['Descanso', '10', '70'], ['Supersticiones','33','84'], ['Festejos', '5', '30'], ['Ventana', '4.23', '50'], ['Lluvia', '20', '80'], ['Leña', '50', '90'], ['Tradiciones', '50', '65'], ['Cielo', '80', '88'], [ 'Familia', '40', '66'], ['Interiores', '20', '40'], ['Reuniones', '56', '70'], ['Compañerismo', '28', '38'], ['Albañilería', '56', '45'], ['Cerveza', '88', '80'], ['Árboles', '26', '20'] ];
    var posiciones = {!! json_encode($story->textNodes) !!}
    posiciones.color = '{{strtolower($story->color)}}';

    var i=0;
    var mult = 1;
    if($(window).width() < 992){
      var mult = 0.710;
    }
    $('.palabras a').each(function() {
    //    $(this).parent().css({ 'top': + posiciones[i].positionY + '%', 'left':  + posiciones[i].positionX + '%' })
    $(this).parent().css({ 'top': + (posiciones[i].positionY * mult) + 'px', 'left':  + (posiciones[i].positionX * mult)  + 'px' })
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
          //  var top = parseInt($(this).css('top')) - 29;
          //  var left = parseInt($(this).css('left')) - 21;
             var top = parseInt($(this).css('top')) ;
             var left = parseInt($(this).css('left'));

            if(($(window).width() < 992) && ($(window).width() > 768)){
              //var top = parseInt($(this).css('top')) - 35;
              //var left = parseInt($(this).css('left')) - 125;
              var top = parseInt($(this).css('top'));
              var left = parseInt($(this).css('left'));
            }
            console.log('vino '+$(this).data('node'));
            $(".modal-opciones-nodo").css({ 'top': top , 'left': left });
            $(".leer").attr('data-node', $(this).data('node'));
            $(".edit").data('edit-node',$(this).data('node'));
            $(".modal-opciones-nodo h2").text($(this).text());
            $(".modal-opciones-nodo").show();

              //console.log('+++NODO : '+$(this).data('edit-node'));
          //  console.log('li id '+$(this).attr('id'));
            saveWordPosition($(this).data('node'), left, top);
          }
        });
    }
    ///---

     //guardar color
     $("#colores").change(function(e) {
        //  console.log($(this).val());
          saveWordsColor($(this).val());
     });

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





    //guardar posicion de palabra
    function saveWordPosition(id, x, y)
    {
        var xhr = new XMLHttpRequest();
        var formData = new FormData();
        console.log('nod prev guardar '+id);
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('nodeId', id);
        formData.append('x', x);
        formData.append('y', y);
    //    console.log(formData);
        // formData.append('_method', 'PATCH');
        xhr.open("POST", "{{ route( 'node.savePosition', $story->_id) }}");
        xhr.send(formData);

        xhr.addEventListener("readystatechange", function (e) {
            var xhr = e.target;
            if (xhr.readyState == 4) {
              //  console.log('h');
                if (xhr.status == 200) {

                    console.log('200');
                    newResponse = JSON.parse(xhr.response);
                    var results = newResponse.results;
                  //  $('.items-listado').empty();
                  //  $('.items-listado').append(results);
                } else console.log(xhr.statusText);
            }
        });
    }

    //guardar posicion de palabra
    function saveWordsColor(color)
    {
        var xhr = new XMLHttpRequest();
        var formData = new FormData();

        formData.append('_token', '{{ csrf_token() }}');
        formData.append('color', color);
        // console.log(formData);
        formData.append('_method', 'PATCH');
        xhr.open("POST", "{{ route( 'story.saveColor', $story->_id) }}");
        xhr.send(formData);

        xhr.addEventListener("readystatechange", function (e) {
            var xhr = e.target;
            if (xhr.readyState == 4) {
              //  console.log('h');
                if (xhr.status == 200) {

                    console.log('200');
                    newResponse = JSON.parse(xhr.response);
                    var results = newResponse.results;
                  //  $('.items-listado').empty();
                  //  $('.items-listado').append(results);
                } else console.log(xhr.statusText);
            }
        });
    }
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

@include('stories.scripts.node-options')
@endpush
