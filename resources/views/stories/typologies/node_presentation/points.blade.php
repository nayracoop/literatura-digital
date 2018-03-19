<div class="grindex-wrapper">
		<div class="grindex points">
			<svg viewBox="0 0 1000 1000">

			</svg>
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

  var nodes = {!!json_encode($story->textNodes)!!};
	var data = {
			"name": "Nodos",
			"value": 10,
			"children": [ ]
		} //30, 86, 16, 90, 77, 28, 30, 86, 16, 90, 77, 28, 30, 86, 16, 90, 77, 28, 30, 86, 16, 90, 77, 28, 30, 86, 16, 90, 77, 28, 30, 86, 16, 90, 77, 28 ];


		var total = 0;
		for(var i = 0; i < nodes.length; i++) {
		//	var val = d3.randomUniform(16, 12512)();
		    val = nodes[i].charCount;
				data.children.push({"_id":nodes[i]._id, "name":nodes[i].title, "value":val, "group": nodes[i].voice });
		//	data.children.push({ "title":"Capitulo 1", "value":val, "group":"group-"+Math.floor(Math.random()*5) });
			total += val;
		}

	var svg = d3.select("svg"),
	    width = 1000,
	    height = 1000;

	//var format = d3.format(",d");

	var color = d3.scaleOrdinal(d3.schemeCategory20c);

	// var pack = d3.pack()
	//     .size([width, height])
	//     .padding(1.5);

	var pack = d3.pack()
		.size([width, height])
		.padding(5);

		var root = d3.hierarchy(data)
		.sum(function(d) { return d.value; });
		//.sort(function(a, b) { return b.value - a.value; });

		//var nodes = pack.nodes(root);

			var node = svg.selectAll(".node")
		    .data(pack(root).leaves())
		    .enter().append("g")
		      .attr("class", "node")
		      .attr("transform", function(d) { console.log(d); return "translate(" + d.x + "," + d.y + ")"; });

					node.append("a")
					.attr("href", "#")
					.attr("data-node", function(d) { return d.data._id; } )
					.classed("leer", true)
					.append("circle")
				      .attr("id", function(d) { return d.id; })
				      .attr("r", function(d) { return d.r; })
							.attr("class", function(d) { return d.data.group; });
				      //.style("fill", function(d) { return color(d.package); });

	</script>
