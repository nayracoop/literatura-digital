<div class="fondo-forms">
    <div class="container">
      <div class="row leer-palabras">
        <div class="col-md-12 {{$story->color}}">

            <div class="palabras">

              <h1>{{$story->title}}</h1>
              <p class="autor">{{$story->getAuthorName()}}</p>

             <ul>
               @php
                    //
                    //print_r($history);
                    $history = new \App\Utils\UserHistory($history);
               @endphp
               @foreach($story->textNodes->where('status','publicado') as $node)
               @php
                    $isRead = $history->isReadNode($story->_id, $node->_id ) ? 'leido' : '';
               @endphp
               <li ><a class="leer {{$isRead}}" data-node="{{ $node->_id }}" id="{{ $node->_id }}"  href="#">{{$node->title}}</a></li>
               @endforeach
             </ul>

             </div>
             @include('snippets.like')
             @include('textNodes.backdrop')
        </div>
      </div>
    </div>
  </div>
@push('javascript')
<script>
  //var posiciones = [ [ '120', '230'], ['Descanso', '110', '370'] ];
    var posiciones = {!! json_encode($story->textNodes) !!}
    var i=0;
    $('.palabras a').each(function() {
      var mult = 1;
      if($(window).width() < 992){
        var mult = 0.710;
      }
  //    console.log('positionY '+posiciones[i].positionY);
  //    console.log('positionX '+posiciones[i].positionX);
      $(this).parent().css({ 'top': + (posiciones[i].positionY * mult) + 'px', 'left':  + (posiciones[i].positionX * mult)  + 'px' })
      i++;
    });

    $('.palabras a').click(function() {
    //  if($('.nodo-backdrop-fondo').hasClass('esconder')){
    //     $('.nodo-backdrop-fondo').removeClass('esconder');
    //     //$('body').addClass('overflow');
  //    }
      //return false;
    });
  </script>
@endpush
