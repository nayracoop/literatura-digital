<tr>
    {{--  <td class="ocultar-lg">
        <a href="#">
            <div class="image-clip">
                @if ($story->cover != null && !empty($story->cover))
                    <img alt="@lang('tapa de') {{$story->title}}" src="{{ asset('imagenes/cover/'.$story->cover )}}"> 
                @else
                <img alt="" src="{{ asset('img/img-3.jpg')}}"> @endif
            </div>
        </a>
    </td>  --}}
    <td><a href="tit-listado">{{ $user->username }}</a></td>
    <td class="ocultar-sm text-left">{{ date('d.m.Y', strtotime($user->created_at) ) }}</td>
    <td class="ocultar-sm">{{ $user->role }}</td>
    <td class="">{{ $user->getName() }}</td>
    <td>
        <a href="#">
            <button>Editar</button>
        </a>
    </td>
</tr>