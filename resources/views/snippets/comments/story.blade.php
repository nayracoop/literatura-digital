<div class="container">
    <div class="comentarios">
      <h2 class="tit-usuario">@lang('messages.comments')</h2>
      <hr />
      <ul>
        @if ($story->comments->count() > 0)
        @foreach ($story->comments->sortByDesc('created_at') as $comment)
            <li>
            <div class="image-clip">
              @if( $comment->user->avatar != null && !empty($comment->user->avatar))
                  <img alt="@lang('Avatar de') {{$comment->user->getName()}}" src="{{ asset('imagenes/avatar/'.$comment->user->avatar )}}"> @else
                  <img src="{{asset('img/img-usuario-default.jpg')}}" alt="" />
              @endif
            </div>
            <h2>{{ $comment->user->getName() }}</h2>
            <p>{{ $comment->content }}</p>
            </li>

        @endforeach
        @else
            <li><p>@lang('messages.no_comments')</p></li>
        @endif
      </ul>

      @if (Auth::check())
          <h4>@lang('Dejar un comentario'):</h4>
          <form role="form" method="POST" action="{{ route('comment.store',$story->slug) }}">
              {{ csrf_field() }}
              <div class="form-group">
                  <textarea class="form-control" rows="3" name="content"></textarea>
              </div>
              <button type="submit" class="btn btn-primary">@lang('Enviar')</button>
          </form>
      @else
          <p>@lang('Inicia sesión para comentar')</p>
      @endif
    </div>
  </div>
