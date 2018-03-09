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

    <div class="grindex-wrapper">
		    <ul class="grindex grid">

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
@push('stylesheets')
<link href="{{asset('css/visualizations.css')}}" rel="stylesheet">
@endpush
@push('javascript')
	<script src="https://d3js.org/d3.v4.min.js"></script>
	<script src="https://d3js.org/d3-path.v1.min.js"></script>
	<script src="https://d3js.org/d3-shape.v1.min.js"></script>
	<script src="https://d3js.org/d3-random.v1.min.js"></script>
	<script src="https://d3js.org/d3-selection-multi.v1.min.js"></script>
	<script type="text/javascript">

	@php
    $data =  [];
		foreach ($story->textNodes as $node) {
			$data[] = $node->charCount;
	  }
	@endphp
  var data = {!!json_encode($data)!!};
	var nodes = {!!json_encode($story->textNodes)!!};

	var boardRow = Math.ceil(Math.sqrt(data.length));
	var boardSize = boardRow*boardRow;
	var bumps = boardSize-data.length;
	var bumpsCount = 0;

	d3.select(".grindex")
  	.selectAll("a")
  	.data(data)
  	.enter()
		.append("li")
		.styles({
			// "animation-delay":function(d) { return d3.randomUniform(-180, 0)() + "s"; },
			// "animation-duration":function(d) { return d3.randomUniform(30, 180)() + "s"; },
			// "animation-direction":function(d) { return (d3.randomUniform(0, 1)() > 0.5) ? "auto" : "reverse"; },
			"width":getTileSize,
			"height":getTileSize,
			"margin-left":getTileSize,
			"margin-right":getTileSize,
		})
		.each(function(d, i) {
			var isBump = (Math.random() < 0.75 && bumpsCount < bumps && (i+bumpsCount)%boardRow != boardRow-1);
			var isBumpRight = (isBump && Math.random()>0.5);
			console.log(i + ", " + bumpsCount + " - " + (i+bumpsCount)%boardRow);
			d3.select(this)
			.classed("variant-" + Math.round(d%3), true)
			.classed("bump-left", (isBump && !isBumpRight))
			.classed("bump-right", isBumpRight);
			if(isBump) bumpsCount++;
		})
		.append("a")
		.attr("href", "#")
		.styles({
			// "animation-delay":function(d) { return d3.randomUniform(-100, 0)() + "s"; },
			// "margin-top":getTilePosition,
			// "margin-left":getTilePosition,
			// "transform":getTileInnerPosition,
		})
		.append("span")
		.styles({
			// "opacity":function(d) { return 0.2 + 1-(d/d3.max(d3.values(data))); },
		})
  	.text(function(d) { return d; });

		function getTileSize(d) {
			var size = 100/boardRow;
			//size *= 100/1;
			return size + "%";
		}

		function getTilePosition(d) {
			var size = (d/d3.max(d3.values(data))*10);
			if(size < 1) size = 12/(document.querySelector(".grindex").offsetWidth)*100;
			size *= 100/1;
			var position = size/-2;
			return position + "%";
		}

		function getTileInnerPosition(d, i) {
			var size = (d/d3.max(d3.values(data))*10);
			if(size < 1) size = 12/(document.querySelector(".grindex").offsetWidth)*100;
			//size *= 100/1;
			var position = 5 + ((i/(data.length-1)) * 37.5);
			position *= 100/size;
			//position += 35;
			return "translateY(" + position + "%)";
		}

	</script>
  @endpush
