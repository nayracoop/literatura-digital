<div class="titulo-nodo">
  <h1 id="tit-nodo">{!!$node->title!!}</h1>
  <span class="acento"><span></span></span>
</div>

<div class="container-nodo">{!!$node->text!!}</div>

<ul class="container-nodo condicionales-ergodico">


@forelse($node->nextNodes as $nn)
{{--print_r($nn)--}}
<li><a href="#" data-nextnode="{{route('node.ergodic',[$story->_id, $nn->nodeId])}}" >{{$nn->label}}</a></li>
@empty
<li><a href="#home" data-nextnode="{{route('node.ergodic',[$story->_id, $story->firstNode()->_id])}}">H</a></li>
@endforelse

</ul>
