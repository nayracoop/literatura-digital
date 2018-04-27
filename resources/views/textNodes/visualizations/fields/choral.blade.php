@php
$voices = $story->choralVoices();
//print_r(json_encode($voices));
@endphp



<div class="row">
	<div class="form-group">
	@foreach($voices as $voice)

		<div class="form-check">
			<input class="form-check-input" id="voice-{{$loop->index}}" type="radio" name="voice" value="{{$voice}}" @if(isset($node) && $node->voice === $voice ) checked  @endif >
			<label for="voice-{{$loop->index}}" class="form-check-label">{{$voice}}</label>
	</div>
	@endforeach
	</div>


  <div class="col-xs-12 col-sm-9">
    <div class="form-group">
   	<label for="new_voice" class="invisibilizar">@lang('Nueva voz')</label>
	  <input id="new_voice" type="text" class="form-control" placeholder="@lang('Nueva voz')..." name="new_voice" >
    </div>
</div>

{{-- @include('visualizations.select_order') --}}
