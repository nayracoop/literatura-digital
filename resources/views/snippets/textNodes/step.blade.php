<h1>
    <span class="numero">{{ $step or '2'}}<span class="invisibilizar">.</span></span>
    @if (isset($node))
        Editar fragmento.
    @else
        Escribí tu primer nodo.
    @endif
</h1>