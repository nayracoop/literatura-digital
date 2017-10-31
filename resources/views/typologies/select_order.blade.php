<div > 
<label class="control-label" for="order">@lang('Orden')</label>
<select id="order" name="order"  class="form-control"  >
	@php
		$last = $story->textNodes->count()+1;
	@endphp
	@for( $i = 1; $i <= $last; $i++)
		<option value="{{$i}}"  @if( $i == $last) selected   @endif >{{$i}}</option>
	@endfor
</select>

</div>