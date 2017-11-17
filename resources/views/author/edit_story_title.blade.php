@if( Auth::check() && Auth::user()->role === 'author' )
<a href="#story-title" class="btn btn-info" data-toggle="collapse"><span class="glyphicon glyphicon-edit"></span> @lang('Editar Título')</a>
<form id="story-title"  class="editable collapse">  
  <input type="text" name="title" value="{{ $story->title }}" />
  <input type="hidden" name="field" value="title" />  

  <button type="submit">Enviar</button>
</form>
@endif
