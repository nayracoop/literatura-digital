
@php
$voices = $story->choralVoices();
@endphp

<div class="form-group">
@foreach($voices as $voice)	
	<label class="control-label">{{$voice->voice}}
	<input type="radio" name="voice" value="{{$voice->voice}}"></label>
@endforeach
</div>

<div class="form-group">
 	<label class="control-label">@lang('Nueva voz')</label>
	<input type="text" class="form-control" placeholder="" name="new_voice" >
</div>

<div class="form-group">
@if($story->textNodes->count() > 0 )
          <label class="control-label">@lang('orden')</label>
          <input type="text" class="form-control" placeholder="" name="order" value="{{$story->textNodes->count()+1}}">
@else
	<input type="hidden" value="1" name="order">
@endif
</div>  