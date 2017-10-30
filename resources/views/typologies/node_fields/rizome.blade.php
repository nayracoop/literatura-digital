<div class="form-group">
          <h3>Asociar</h3>
          @foreach($story->textNodes as $node)
             <label class="control-label">{{$node->title}}<input type="checkbox" name="nodes[]" value="{{ $node->_id }}"></label>
          @endforeach
        </div>  