@php
$first = $story->textNodes->sortBy('created_at')->first()->created_at;
$firstMonth = $first->month;
$firstYear = $first->year;
//echo $firstYear;
@endphp
<div class="fondo-forms">
    <div class="container">
      <div class="row leer-palabras">
        <div class="col-md-12">

          <div class="nodo-data-relato">
              <div class="image-clip">
                @if($story->cover != null && !empty($story->cover))
                    <img alt="@lang('tapa de') {{$story->title}}" src="{{ asset('imagenes/cover/'.$story->cover )}}"> @else
                    <img alt="" src="{{ asset('img/img-relato-default.jpg')}}">
                @endif
              </div>
              <p class="tit-relato">{{$story->title}}</p>
              <p class="autor-relato">{{$story->getAuthorName()}}</p>
          </div>

          <div id="grilla-calendario" class="container-nodo"></div>

        </div>
      </div>
    </div>
  </div>
@include('textNodes.backdrop-calendar')
@push('javascript')
<script type="text/javascript">

loadMonthCalendar({{$firstMonth}}, {{$firstYear}});
function loadMonthCalendar(month, year)
{

  var xhr = new XMLHttpRequest();

  xhr.open("GET", '{{ route("node.getMonthCalendar", $story ) }}');
  xhr.send('month='+month+'&year='+year);

  xhr.addEventListener("readystatechange", function (e) {
      var xhr = e.target;
      if (xhr.readyState == 4) {
          if (xhr.status == 200) {
              console.log('200');
              newResponse = JSON.parse(xhr.response);
              $('#grilla-calendario').html(newResponse.calendar);

              //$('.leer').click(function(ev) {
                  readNode( );
              //});

            //  var id = newResponse.id;
              // var alert = "include('snippets.flash.saved_changes')";
              // var  alert = '<div class="alert alert-success">@lang("Tus cambios han sido guardados")</div>';

            //  var redirect = newResponse.redirect;

            //  if (redirect != null) {
            //      window.location.replace(redirect);
            //  }
              //   $('.container.formulario').prepend(alert);

          } else console.log(xhr.statusText);
      }
  });
}
</script>
@endpush
