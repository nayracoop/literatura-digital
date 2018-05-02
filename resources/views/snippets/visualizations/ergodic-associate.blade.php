<div class="nodo-ergodico-backdrop-fondo esconder">
  <div class="nodo-ergodico-backdrop" id="ventana-nodo-ergodico" tabindex="-1" role="dialog" aria-labelledby="tit-nodo" aria-hidden="true">

  <a class="back-button cerrar-nodo close-arrow close-add-nodo-ergodico" href="#">Volver</a>

   <div class="row">



  <!--<div class="col-md-8 col-lg-9"> <div class="col-md-4 col-lg-3"> -->
  <h2 class="tit-usuario">Elegí un nodo</h2>
  <hr />
    <ul class="listado-nodos-ergodicos">
        @foreach($story->textNodes as $n)
        <div class="col-md-4 col-lg-3">
          <li data-nodo-id="{{$n->_id}}">
            <h3>{{$n->title}}</h3>
            <hr />
            <p>{!! substr($n->text,0,100) !!}</p>
            <div class="container-checkbox">
              <div class="check-left">
                <div class="check">
                  <label class="checkbox" for="asociar-{{$n->_id}}"><input name="associateNode-{{$n->_id}}" @if( isset($node->next) && $node->isNext($n->_id)) checked="checked" @endif type="checkbox" id="asociar-{{$n->_id}}"><span class="tick"></span>Asociar nodo</label>
                </div>
             </div>
            </div>
            <a href="#" data-node="{{$n->_id}}" class="leerde">Leer nodo</a>
          </li>
        </div>
        @endforeach
    </ul>
    </div>
  <!--  </div> -->

  </div>
</div>
@push('javascript')
<script type="text/javascript">
$('.asociar').click(function(e) {
    e.preventDefault();

    var array_page = [];
    var array_modal = [];

    $(".listado-nodos-ergodicos li").each(function() {
      array_modal.push($(this).data('nodo-id'));
    });

    $(".preguntas-ergodico li").each(function() {
      array_page.push($(this).data('nodo-id'));
    });

    var diferencia_modal = $(array_modal).not(array_page).get();
    //console.log(diferencia);

    $(".listado-nodos-ergodicos li input:checkbox").each(function() {
      $(this).removeAttr('checked'); //medio cabeza pero el click es un toggle
      $(this).click();
    });

    for (i = 0; i < diferencia_modal.length; i++) {
      $('.listado-nodos-ergodicos li[data-nodo-id="'+ diferencia_modal[i] +'"] input:checkbox').removeAttr('checked');
    }


    if($('.nodo-ergodico-backdrop-fondo').hasClass('esconder')){
      $('.nodo-ergodico-backdrop-fondo').removeClass('esconder');
      //$('body').addClass('overflow');
    }

  });


  $('.preguntas-ergodico').on('click','li .delete-node', function(e){
      e.preventDefault();
      $(this).parent().remove();
  });


  /* Cuando cierro agregar nodos */
  $('.close-add-nodo-ergodico').click(function(e) {
        e.preventDefault();
        var array_page = [];
        var array_modal_checked = [];

        $(".listado-nodos-ergodicos li input:checked").each(function() {
          array_modal_checked.push($(this).parent().parent().parent().parent().parent().data('nodo-id'));
        });

        $(".preguntas-ergodico li").each(function() {
          array_page.push($(this).data('nodo-id'));
        });

        diferencia_modal = $(array_modal_checked).not(array_page).get();

        var selector_diferencia = "";
        for (i = 0; i < diferencia_modal.length; i++) {
         selector_diferencia += '.listado-nodos-ergodicos li[data-nodo-id="'+ diferencia_modal[i] +'"]';
         if(i !== (diferencia_modal.length - 1)){
          selector_diferencia += ", ";
         }
        }
        console.log(selector_diferencia);


        var lis = parseInt($(".listado-nodos-ergodicos li").length);
        $(selector_diferencia).each(function() {
          lis++;
          var nodeId = $(this).attr('data-nodo-id');
          var datosLi = '<li data-nodo-id="' + nodeId + '">' + "\n"
          + '<button class="delete-pregunta-ergodico delete-node">Desasociar nodo</button>'
          + "\n" +  '<label for="pregunta' + lis + '" class="invisibilizar">Pregunta '      + lis + '</label>'
          +'<input type="hidden" name="nextNodeTag[]" value="'+nodeId+ '" >'+
           '<input type="text" class="form-control input-pregunta-ergodico" id="pregunta' + lis + '"  name="titleNode_'+nodeId+'" >' + "\n" + '<div class="opciones-preguntas-ergodico">' + "\n" + '<div class="tit-preguntas-ergodico">' + "\n" + '<h2>' + $(this).children('h3').text() + '</h2>' + "\n" + '<hr />' + "\n" + '</div>' + "\n" + '<div class="botones-preguntas-ergodico">' + "\n" + '<a href="#" class="dia">Leer nodo</a>' + "\n" + '<a href="#" class="asociar">Editar nodo</a>' + "\n" + '</div>' + "\n" + '</div>' + "\n" + '</li>';

          $(".preguntas-ergodico").append(datosLi);
        });

  });

</script>
@endpush
