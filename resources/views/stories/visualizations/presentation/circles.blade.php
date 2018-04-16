<div class="grindex-wrapper strict-limits">
		<ul class="grindex circles">

		</ul>
</div>

@include('textNodes.backdrop')
@push('stylesheets')
<link href="{{asset('css/visualizations.css')}}" rel="stylesheet">
<!-- <link href="{{asset('css/reset.css')}}" rel="stylesheet"> -->
@endpush
@push('javascript')
<script src="https://d3js.org/d3.v4.min.js"></script>
<script src="https://d3js.org/d3-path.v1.min.js"></script>
<script src="https://d3js.org/d3-shape.v1.min.js"></script>
<script src="https://d3js.org/d3-random.v1.min.js"></script>
<script src="https://d3js.org/d3-selection-multi.v1.min.js"></script>
<script type="text/javascript">
var data = [ ];//30, 86, 16, 90, 77, 28, 30, 86, 16, 90, 77, 28, 30, 86, 16, 90, 77, 28, 30, 86, 16, 90, 77, 28, 30, 86, 16, 90, 77, 28, 30, 86, 16, 90, 77, 28 ];
	for(var i = 0; i < d3.randomUniform(5, 64)(); i++) {
		data.push(d3.randomUniform(16, 12512)());
	}

  @php
	  $textNodes = [];
    $data =  [];
    $voices = $story->choralVoices();
    foreach ($story->textNodesPublished() as $node) {
      $data[] = $node->charCount;
    //  $voices[] = $node->voice;
		  $textNodes[] = $node; 
    }
  @endphp
  var data = {!!json_encode($data)!!};
  var nodes = {!!json_encode($textNodes)!!};
  var voices = {!! json_encode($voices) !!}

	var boardRow = Math.ceil(Math.sqrt(data.length))+1;
	var boardSize = boardRow*boardRow;
	var bumps = boardSize-data.length;
	var bumpsCount = 0;

	d3.select(".grindex")
		.each(function(d, i) {
			for(i = 0; i < 4; i++) {
				d3.select(this)
				.append("span")
				.classed("frame", true)
				.styles({
					"width":getTileSize,
					"height":getTileSize,
					"top":getTileNegHalfSize,
					"right":getTileNegHalfSize,
					"bottom":getTileNegHalfSize,
					"left":getTileNegHalfSize,
				})
				.each(function(d, i) {
					for(i = 0; i < boardRow+1; i++) {
						d3.select(this)
						.append("span")
						.classed("frame", true)
					}
				})
			}
		})
  	.selectAll("a")
  	.data(nodes)
  	.enter()
		.append("li")
		.styles({
			// "animation-delay":function(d) { return d3.randomUniform(-180, 0)() + "s"; },
			// "animation-duration":function(d) { return d3.randomUniform(30, 180)() + "s"; },
			// "animation-direction":function(d) { return (d3.randomUniform(0, 1)() > 0.5) ? "auto" : "reverse"; },
			"width":getTileSize,
			"height":getTileSize,
		})
		.each(function(d, i) {
			var isBump = (i%(boardRow-1)) == 0;//(Math.random() < 0.75 && bumpsCount < bumps && (i+bumpsCount)%boardRow != boardRow-1);
			var isBumpTop = (i<boardRow-1);
			d3.select(this)
			.classed("variant-" + voices.indexOf(d.voice), true)
			.styles({
				"margin-left":(isBump) ? getTileHalfSize : "0",
				"margin-top":(isBumpTop) ? getTileHalfSize : "0",
			})
			// .classed("bump-left", isBump)
			// .classed("bump-top", isBumpTop);
			if(isBump) bumpsCount++;
		})
		.append("a")
		.attr("href", "#")
    .classed('leer', true)
    .attr("data-node", function(d){return d._id;})
		.attr("title", d.title)
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

		function getTileHalfSize(d) {
			var size = 50/boardRow;
			//size *= 100/1;
			return size + "%";
		}

	function getTileNegHalfSize(d) {
			var size = 50/boardRow;
			//size *= 100/1;
			return "-" + size + "%";
		}

		function getTilePosition(d) {
			var size = (d.charCount / d3.max(d3.values(data))*10);
			if(size < 1) size = 12/(document.querySelector(".grindex").offsetWidth)*100;
			size *= 100/1;
			var position = size/-2;
			return position + "%";
		}

		function getTileInnerPosition(d, i) {
			var size = (d.charCount /d3.max(d3.values(data))*10);
			if(size < 1) size = 12/(document.querySelector(".grindex").offsetWidth)*100;
			//size *= 100/1;
			var position = 5 + ((i/(data.length-1)) * 37.5);
			position *= 100/size;
			//position += 35;
			return "translateY(" + position + "%)";
		}

</script>
@endpush
