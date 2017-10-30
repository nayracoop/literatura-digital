
<div class="form-group">
@if($story->textNodes->count() > 0 )
          <label class="control-label">@lang('orden')</label>
          <input type="text" class="form-control" placeholder="" name="order" value="{{$story->textNodes->count()+1}}">
@else
	<input type="hidden" value="1" name="order">
@endif
</div>  