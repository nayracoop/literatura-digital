@extends('layouts.main')
@section('title')
    {{ $user->getName() }} 
@endsection 

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="datos-usuario">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        @if ($isOwner)
                            <div class="editar-usuario btn btn-guardar">
                                <a href="{{ route('user.edit') }}">Editar</a>
                            </div>
                        @endif

                        <div class="data-relato">
                            <div class="image-clip">
                                @if( $user->avatar != null && !empty($user->avatar))
                                    <img alt="@lang('Avatar de') {{$user->getName()}}" src="{{ asset('imagenes/avatar/'.$user->avatar )}}"> @else
                                    <img src="{{asset('img/img-usuario.jpg')}}" alt="" /> 
                                @endif
                            </div>
                            <p class="nom-usuario">{{ $user->getName() }}</p>
                            <p class="fecha-usuario">@lang('Se ha unido el') {{ strftime ( '%e de %B de %Y' , strtotime($user->created_at) ) }}</p>
                            <hr />
                            <div class="descripcion-usuario">
                                <p>{{ $user->description }}</p>
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
                @include('stories.block_list', ['title' => __('messages.stories_of') . $user->getName(), 'stories' => $user->getStories()])
                {{--  <h2 class="tit-usuario"></h2>
                <hr />
                <div class="row">
                    @foreach($user->getStories() as $story) 
                        @include('stories.summary')
                    @endforeach
                </div>  --}}
            </div>
        </div>
    </div>
</div>
@endsection