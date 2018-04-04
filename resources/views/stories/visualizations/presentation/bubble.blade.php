
	<div class="fondo-forms">
		<div class="grindex-wrapper strict-limits">
			<ul class="grindex bubbles">
			</ul>
		</div>
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

	// var w = 920;
	// var h = 920;
  //
	// var svg = d3.select("#wrapper")
	// 		.append("svg")
	// 		.attr("width",w)
	// 		.attr("height",h);
  //
	// var text = svg.append("text")
	// 		.text("hello world")
	// 		.attr("y",50);
  //
	// var arc = d3.arc()
	// 		.innerRadius(0)
	// 		.outerRadius(100)
	// 		.startAngle(0)
	// 		.endAngle(Math.PI / 2);
	// arc(); // "M0,-100A100,100,0,0,1,100,0L0,0Z"

///	var data = [ ];//30, 86, 16, 90, 77, 28, 30, 86, 16, 90, 77, 28, 30, 86, 16, 90, 77, 28, 30, 86, 16, 90, 77, 28, 30, 86, 16, 90, 77, 28, 30, 86, 16, 90, 77, 28 ];
	//for(var i = 0; i < d3.randomUniform(5, 64)(); i++) {
	//	data.push(d3.randomUniform(16, 12512)());
//	}
  @php
    $data =  [];
    foreach ($story->textNodes as $node) {
      $data[] = $node->charCount;
    }
  @endphp
  var data = {!!json_encode($data)!!};
  var nodes = {!!json_encode($story->textNodes)!!};

	d3.select(".grindex")
  	.selectAll("a")
  	.data(nodes)
  	.enter()
		.append("li")
		.styles({
			"animation-delay":function(d) { return d3.randomUniform(-180, 0)() + "s"; },
			"animation-duration":function(d) { return d3.randomUniform(30, 180)() + "s"; },
			"animation-direction":function(d) { return (d3.randomUniform(0, 1)() > 0.5) ? "auto" : "reverse"; },
		})
		.append("a")
    .attr('data-node', function(d){ return d._id })
    .classed("leer", true)
		.attr("href", "#")
		.styles({
			"animation-delay":function(d) { return d3.randomUniform(-100, 0)() + "s"; },
			"margin-top":getBubblePosition,
			"margin-left":getBubblePosition,
			"width":getBubbleSize,
			"height":getBubbleSize,
			"transform":getBubbleInnerPosition,
		})
		.append("span")
		.styles({
			"opacity":function(d) { return 0.2 + 1-(d.charCount/d3.max(d3.values(data))); },
		})
  	.text(function(d) { return d; });

		function getBubbleSize(d) {
			var size = (d.charCount/d3.max(d3.values(data))*10);
			size *= 100/1;
			return size + "%";
		}

		function getBubblePosition(d) {
			var size = (d.charCount/d3.max(d3.values(data))*10);
			if(size < 1) size = 12/(document.querySelector(".grindex").offsetWidth)*100;
			size *= 100/1;
			var position = size/-2;
			return position + "%";
		}

		function getBubbleInnerPosition(d, i) {
			var size = (d.charCount/d3.max(d3.values(data))*10);
			if(size < 1) size = 12/(document.querySelector(".grindex").offsetWidth)*100;
			//size *= 100/1;
			var position = 5 + ((i/(data.length-1)) * 37.5);
			position *= 100/size;
			//position += 35;
			return "translateY(" + position + "%)";
		}

	</script>
  @endpush
