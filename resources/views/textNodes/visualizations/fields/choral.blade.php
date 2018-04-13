@php
$voices = $story->choralVoices();
//print_r(json_encode($voices));
@endphp

<div class="form-group">
@foreach($voices as $voice)
	<label class="control-label">{{$voice}}
	<input type="radio" name="voice" value="{{$voice}}" @if(isset($node) && $node->voice === $voice )  @endif ></label>
@endforeach
</div>

<div class="form-group">
 	<label class="control-label">@lang('Nueva voz')</label>
	<input type="text" class="form-control" placeholder="" name="new_voice" >
</div>

{{-- @include('visualizations.select_order') --}}
