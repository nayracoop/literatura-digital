<div class="nodo-ergodico-backdrop-fondo esconder">
  <div class="nodo-ergodico-backdrop" id="ventana-nodo-ergodico" tabindex="-1" role="dialog" aria-labelledby="tit-nodo" aria-hidden="true">

  <a class="back-button cerrar-nodo close-arrow close-add-nodo-ergodico" href="#">Volver</a>

   <div class="row">



  <!--<div class="col-md-8 col-lg-9"> <div class="col-md-4 col-lg-3"> -->
  <h2 class="tit-usuario">Elegí un nodo</h2>
  <hr />
    <ul class="listado-nodos-ergodicos">
        @foreach($story->textNodes as $node)
        <div class="col-md-4 col-lg-3">
          <li data-nodo-id="{{$node->_id}}">
            <h3>{{$node->title}}</h3>
            <hr />
            <p>{!! substr($node->text,0,100) !!}</p>
            <div class="container-checkbox">
              <div class="check-left">
                <div class="check">
                  <label class="checkbox" for="asociar-{{$node->_id}}"><input name="associateNode-{{$node->_id}}" checked="checked" type="checkbox" id="asociar-{{$node->_id}}"><span class="tick"></span>Asociar nodo</label>
                </div>
             </div>
            </div>
            <a href="#" data-node="{{$node->_id}}" class="leer">Leer nodo</a>
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
      $('body').addClass('overflow');
    }

  });

</script>
@endpush
