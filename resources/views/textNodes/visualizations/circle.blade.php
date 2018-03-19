<div class="col-md-12">
    @include('snippets.stories.data')
    @include('snippets.textNodes.modes_tabs')


    <div id="modo-visualizacion" class="tabpanel active">
        <div class="row" style="clear: both;">
              <div class="col-sm-7 col-md-6 tit-editor-visual">
                    <h1>Visualización</h1>
                    <hr />
              </div>
    </div>

    <div class="row formulario" style="clear: both;">
    <div class="col-md-12">

      <div class="grindex-wrapper strict-limits">
      		<ul class="grindex circles">

      		</ul>
      </div>

		<div class="modal-opciones-nodo modal-left">
      <h2>---</h2>
      <hr />
      <a href="#" class="leer">Leer nodo</a>
      <a href="#" class="edit" data-edit-node="">Editar nodo</a>
    </div>

</div>
</div>
</div>


  @include('textNodes.backdrop')
  @push('stylesheets')
  <link href="{{asset('css/visualizations.css')}}" rel="stylesheet">
  <!-- <link href="{{asset('css/reset.css')}}" rel="stylesheet"> -->
  @endpush
  @push('javascript')
  @endpush
