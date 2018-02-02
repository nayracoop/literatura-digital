<tr>
    <td class="ocultar-lg">
        <a href="#{{--  {{route('story.nodes',$story->_id)}}  --}}">
            <div class="image-clip">
                @if($user->avatar != null && !empty($user->avatar))
                    <img alt="@lang('messages.avatar_of') {{ $user->username }}" src="{{ asset('imagenes/avatar/' . $user->avatar)}}">
                @else
                    <img alt="" src="{{ asset('img/img-usuario.jpg') }}">
                @endif
            </div>
        </a>
    </td>
    <td class="tit-listado"><a href='{{ route("admin.user.edit", $user->_id) }}'>{{ $user->username }}</a></td>
    <td class="ocultar-sm text-left">{{ date('d.m.Y', strtotime($user->created_at) ) }}</td>
    <td class="ocultar-sm">{{ $user->role }}</td>
    <td class="">{{ $user->getName() }}</td>
    <td>
        <a href="#">
            <button>Editar</button>
        </a>
    </td>
</tr>