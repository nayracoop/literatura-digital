@extends('layouts.main')
@section('title') @lang('Buscar Relatos') @endsection
@section('body_class') class="white" @endsection
@section('content')

<div class="container-fluid">
    <div class="row">
      <div class="encabezado-categoria">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h1>{{ ucfirst($title) }}</h1>
              <div class="container-tags">
                @forelse($tags as $tag)
                  <p><a href="#{{$tag->name}}">#{{$tag->name}}</a></p>
                  @empty
                      No hay etiquetas asociadas
                @endforelse
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="buscador">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <form id='stories_search'>
              <input type='text' name='search' placeholder="@lang('messages.search_stories')" />
              <input type='hidden' name='genre' value='{{ $genre }}' />
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid fondo-gris">
    <div class="container items-listado">
      @include('stories.block_list')
    </div>
  </div>

@endsection

@push('javascript')
<script>
//formElement = document.getElementById("stories_search");
$('#stories_search').on('submit', function (e) {
  e.preventDefault();
});

$('input[name="search"]').bind('input', function () {
  search();
});

window.addEventListener("hashchange", function (e) {
  search();
}, false);

function search() {
  formElement = document.getElementById("stories_search");

  var xhr = new XMLHttpRequest();
  var formData = new FormData(formElement);
  formData.append('tag', location.hash.substring(1));

  // formData.append('_token', '{{ csrf_token() }}');
  // console.log(formData);
  // formData.append('_method', 'PATCH');

  xhr.addEventListener("readystatechange", function (e) {
    var xhr = e.target;
    if (xhr.readyState == 4) {
      // console.log('h');
      if (xhr.status == 200) {
        //console.log('200');
        newResponse = JSON.parse(xhr.response);
        var stories = newResponse.stories;
        $('.items-listado').empty();
        $('.items-listado').append(stories);
        hashChangedUpdate();
        // todo agregar funcionalidad:
        // clase a la etiqueta clickeada y (x)
        // para eliminar el filtro por etiqueta

        // var tags = newResponse.tags;
        // console.log(newResponse);
        // console.log(tags);
        // $('.container-tags').empty();
        // $('.container-tags').append(tags.etiqueta.name);
      } else {
        //console.log(xhr.statusText);
      }
    }
  });

  xhr.open("POST", "{{ route( 'stories.search') }}");
  xhr.setRequestHeader('X-CSRF-Token', "{{ csrf_token() }}");
  xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
  xhr.send(formData);
}
</script>
@endpush
