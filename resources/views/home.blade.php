@extends('layouts.main')

@section('title')
    @lang('Inicio')
@endsection

@section('content')
    @include('about')
    <div class="container-fluid fondo-gris">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="tit-home" id="list_title">@lang('messages.favorites')</h2>
                    <hr />
                    @include('stories.block_list')
                </div>
            </div>
        </div>
    </div>  
@endsection


{{--  @push('javascript')
esto pasa a estar en la lista de historias
    <script>
        function hashChangedUpdate() {
            $(".status_switch:checkbox").on("click", changeStatus);

            function changeStatus(event) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        var response = JSON.parse(xhttp.response);
                        //console.log(response.results);
                    } else {
                        //console.log(xhttp.statusText);
                    }
                };
                xhttp.open("POST", "{{ route('story.change-status') }}", true);
                xhttp.setRequestHeader('X-CSRF-Token', "{{ csrf_token() }}");
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("id=" + event.target.id);
            }
        }
    </script>
@endpush  --}}
