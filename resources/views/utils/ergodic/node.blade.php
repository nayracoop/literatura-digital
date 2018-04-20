<div class="titulo-nodo">
  <h1 id="tit-nodo">{!!$node->title!!}</h1>
  <span class="acento"><span></span></span>
</div>

<div class="container-nodo">{!!$node->text!!}</div>

<ul class="container-nodo condicionales-ergodico">

@if(isset($node->next))
@foreach($node->next as $nn)
{{--print_r($nn)--}}
<li><a href="#" data-nextnode="{{route('node.ergodic',[$story->_id, $nn['id']])}}" >{{$nn['title']}}</a></li>
@endforeach
@endif
</ul>
