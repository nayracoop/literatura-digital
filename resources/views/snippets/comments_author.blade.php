<div class="well">
@if( Auth::check() )
  <h4>@lang('Dejar un comentario'):</h4>
  <form role="form" method="POST" action="{{ route('comment.author.store',$author->slug) }}">
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
<hr>
@if( isset($author->comments) && $author->comments->count() > 0 )
@foreach( $author->comments->sortByDesc('created_at') as $comment )
<h3>{{  $comment->user->getName() }}
  <small>{{ $comment->created_at }}</small></h3>
<p>{{ $comment->content }}</p>
@endforeach
@else
<p>@lang('No hay comentarios')</p>
@endif
