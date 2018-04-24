{{--  {{ csrf_field() }}  --}}
<div class="row">
    <div class="col-sm-9 tit-nodo">
        <div class="form-padding-interno">
            <label for="titulo">Título <i>(opcional)</i></label>
            <input type="text" class="form-control" id="titulo" name="title" @if (isset($node)) value="{{ $node->title }}" @endif>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-9">
        <label for="texto-nodo" class="invisibilizar">Texto *</label>
        <div id="texto-nodo" class="texto-nodo">@if (isset($node)) {!! $node->text !!} @endif</div>
    </div>
    <div class="col-xs-12 col-sm-3 contador">
        <h2 class="invisibilizar">Contador de caracteres y palabras del nodo</h2>
        <p>
            <strong class="contador-palabras">
                @if (isset($node)) {{ $node->wordCount }} @else 0 @endif
            </strong> palabras
        </p>
        <input name="wordCount" type="hidden" />
        <p>
            <strong class="contador-caracteres">
                @if (isset($node)) {{ $node->charCount }} @else 0 @endif
            </strong> caracteres
        </p>
        <input name="charCount" type="hidden" />

        @if($story->getVisualization()->slug === 'ergodic')
        <div class="orden-nodo">
        <label for="orden">Inicio</label>
          <div class="styled-select">
            <select name="first_node" type="text" class="form-control" id="orden">
              <option   @if (isset($node->firstNode) && $node->firstNode ) selected @endif value="1">Sí</option>
              <option   @if (!isset($node->firstNode) || !$node->firstNode ) selected @endif >No</option>
            </select>
          </div>
        </div>
        @endif 

    </div>
</div>

<textarea name="text" class="hidden"></textarea>
<input name="story" value="{{ $story->_id }}" type="hidden" />
<input name="status" id="nodeStatus" value="@if (isset($node)) {{ $node->status }} @else {{ \App\Models\Enums\Status::DRAFT }} @endif" type="hidden" />
@if (isset($node))
    <input name="id" id="nodeId" value="{{ $node->_id }}" type="hidden" />
@endif

@if($story->typology->slug === 'choral')
@include('textNodes.visualizations.fields.'.$story->typology->slug)

@elseif($story->typology->slug === 'ergodic')
@include('textNodes.visualizations.fields.'.$story->typology->slug)
@endif
