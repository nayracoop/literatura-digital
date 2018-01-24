@extends('layouts.main')
@section('title')
    {{ $author->getName() }} 
@endsection 

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="datos-usuario">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="data-relato">
                            <div class="image-clip">
                                @if( $author->avatar != null && !empty($author->avatar))
                                    <img alt="@lang('Avatar de') {{$author->getName()}}" src="{{ asset('imagenes/avatar/'.$author->avatar )}}"> @else
                                    <img src="{{asset('img/img-usuario.jpg')}}" alt="" /> 
                                @endif
                            </div>
                            <p class="nom-usuario">{{ $author->getName() }}</p>

                            <p class="fecha-usuario">@lang('Se ha unido el') {{ strftime ( '%e de %B de %Y' , strtotime($author->created_at) ) }}</p>
                            <hr />
                            <div class="descripcion-usuario">
                                <p>{{ $author->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid fondo-gris">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="tit-usuario">@lang('Relatos de') {{ $author->getName() }}</h2>
                <hr />
                <div class="row">
                    @foreach($author->getStories() as $story) 
                        @include('stories.summary') 
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection