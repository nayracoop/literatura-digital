@extends('layouts.main')
@section('title')
@lang('Editar nodo')
@endsection
@section('content')
<div class="fondo-forms">
    <div class="container formulario form-detalle">
        <div class="row">
            <div class="col-lg-12">
                @if ($story->textNodes->count() > 0)
                    {{--  INFO DE LA ¡HISTORIA! EXISTENTE  --}}
                    @include ('snippets.stories.data')
                @else
                    {{--  PASO EN EL "WIZARD"  --}}
                    @include ('snippets.textNodes.step')
                @endif
            </div>
        </div>
        <form role="form" id="node-form" method="POST">

            {{--  CAMPOS DEL FORM  --}}
            @include ('snippets.textNodes.form_fields')
            @include ('snippets.textNodes.form_date_selection')
            @if($story->typology->slug === 'choral')
            @include('textNodes.visualizations.fields.'.$story->typology->slug)

            @elseif($story->typology->slug === 'ergodic')
            @include('textNodes.visualizations.fields.'.$story->typology->slug)
            @endif
        </form>
        {{--  BOTONERA  --}}
        @include ('snippets.textNodes.form_buttons')
    </div>
</div>
@endsection

@push('javascript')
    @include('textNodes.scripts.save-update')
    @include('textNodes.scripts.upload-picture')
    <link href="{{asset('js/libs/summernote/summernote.css')}}" rel="stylesheet">
    <script src="{{asset('js/libs/summernote/summernote.es.min.js')}}"></script>
    <script src="{{asset('js/functions-summernote.js')}}"></script>
    <script>
        @if (isset($node))
            $(document).ready(function() {
                $('textarea[name="text"]').html($('.note-editable').html());
                updateCount();
            });
        @endif
    </script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\CreateTextNode') !!}
@endpush
