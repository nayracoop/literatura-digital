@extends('layouts.main') 

@section('title')
    @lang('messages.new_story')
@endsection

@push('stylesheets')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/css/selectize.default.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/css/selectize.bootstrap3.min.css.map" />
@endpush

@section('content')
<div class="fondo-forms">
    <div class="container formulario form-detalle">
        <div class="row">
            <div class="col-lg-12">
                @if (isset($story))
                    {{--  INFO DE LA HISTORIA EXISTENTE  --}}
                    @include ('snippets.stories.data')
                @else
                    {{--  PASO EN EL "WIZARD"  --}}
                    @include ('snippets.stories.step')
                @endif
            </div>

            <form role="form" id="story-form">
                {{--  CAMPOS DEL FORM  --}}
                @include ('snippets.stories.form_fields')
            </form>

            {{--  BOTONERA  --}}
            @include ('snippets.stories.form_buttons')
        </div>
    </div>
</div>
@endsection

@push('javascript')
@include('stories.scripts.save-update')
@include('stories.scripts.tags')
@include('stories.scripts.upload-picture')
<?php $validator = JsValidator::formRequest('App\Http\Requests\CreateStory', '#story-form'); ?>
{!! $validator->view('layouts.validation') !!}
@endpush
