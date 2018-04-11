
<div class="grindex-wrapper">
  <div class="grindex kaleidoscope">
    <svg>

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

  @php
    $data =  [];
		foreach ($story->textNodes as $node) {
			$data[] = $node->charCount;
	  }
	@endphp
  var data = {!!json_encode($data)!!};
	var nodes = {!!json_encode($story->textNodes)!!};
  //var data = [90 ];//30, 86, 16, 90, 77, 28, 30, 86, 16, 90, 77, 28, 30, 86, 16, 90, 77, 28, 30, 86, 16, 90, 77, 28, 30, 86, 16, 90, 77, 28, 30, 86, 16, 90, 77, 28 ];
	//for(var i = 0; i < d3.randomUniform(5, 64)(); i++) {
		//data.push(d3.randomUniform(16, 12512)());
	//}

	var boardRow = Math.ceil(Math.sqrt(data.length));
	var boardRowV = Math.ceil(boardRow*2/3);
	var boardRowH = 2*boardRowV;
	var boardSize = boardRowV*boardRowH;
	if(boardSize < boardRow*boardRow) {
		boardRowV++;
		boardRowH = 2*boardRowV;
		boardSize = boardRowV*boardRowH;
	}
	var bumps = boardSize-data.length-1;
	var bumpsCount = 0;//Math.floor(bumps / 2);
	var bumpsFreq = Math.round(boardSize / bumps);
	var triaglePos = 0;

	var grindex = d3.select(".grindex svg");

	grindex.attr("viewBox", "0 0 1000 1000")
		.each(function() {
			var size = getTileSize();
			var half = size/2;

			if(Math.floor(bumps / 2)-1 > 0) triaglePos = 1;

			for(var j = 0; j < Math.floor(bumps / 2); j++) {

				var n = bumpsCount;
				if(n%boardRowH == 0 && boardRowH%2 == 0) triaglePos++;

				var x = (half/-2) + half * (1+n%((boardRowV)*2));
				var y = size * Math.floor(n/((boardRowV)*2));
				var draw = "";

				triaglePos++;
				bumpsCount++;

				if(triaglePos%2) draw = 'M ' + x + ' ' + (y + size) + ' l ' + half + ' -' + size + ' l -' + size + ' 0 z';
				else draw = 'M ' + x + ' ' + y + ' l ' + half + ' ' + size + ' l -' + size + ' 0 z';

				grindex.append('path')
        .attr('d', draw)
        .attr('stroke', '#fff')
        .attr('stroke-width', 'thin')
			}
		})
		.selectAll("a")
		.data(nodes)
		.enter()
		.append("a")
		//.attr("href", "#")
    .attr('data-node', function(d){ console.log('D'+ d); return d._id })
    .classed("leer", true)

		.append('path')
      .attr('d', function(d, i) {

				var size = getTileSize(d.wordCount);
				var half = size/2;

				var n = i + bumpsCount;
        var x, y;
        var isFirst = false;

				if(n == boardRowH-1 && triaglePos%2 == 0) {
					n++;
					bumpsCount++;
					triaglePos++;
				}
				if(n == boardSize-boardRowH && triaglePos%2 == 0) {
					n++;
					bumpsCount++;
          isFirst = true;
					// triaglePos++;
				}
				if(n%boardRowH == 0 && boardRowH%2 == 0) triaglePos++;

        if(n%boardRowH == 0 || isFirst) {
          var draw;
          x = (half/-2) + half * (1+n%((boardRowV)*2));
          y = size * Math.floor(n/((boardRowV)*2));
          if(triaglePos%2) draw = 'M ' + (x-half) + ' ' + (y + size) + ' l ' + half + ' -' + size + ' l -' + size + ' 0 z';
          else draw = 'M ' + (x-half) + ' ' + y + ' l ' + half + ' ' + size + ' l -' + size + ' 0 z';
          grindex.append('path')
          .attr('d', draw)
          .attr('stroke', '#fff')
          .attr('stroke-width', 'thin');
        } else if(n%boardRowH == boardRowH-1) {
          var draw;
          x = (half/-2) + half * (1+n%((boardRowV)*2));
          y = size * Math.floor(n/((boardRowV)*2));
          if(triaglePos%2) draw = 'M ' + (x+half) + ' ' + (y + size) + ' l ' + half + ' -' + size + ' l -' + size + ' 0 z';
          else draw = 'M ' + (x+half) + ' ' + y + ' l ' + half + ' ' + size + ' l -' + size + ' 0 z';
          grindex.append('path')
          .attr('d', draw)
          .attr('stroke', '#fff')
          .attr('stroke-width', 'thin');
        }

				/*if(i != 0 && i%bumpsFreq == 0) {
					triaglePos++;
					bumpsCount++;
					n = i + bumpsCount;
					if(n%boardRowH == 0 && boardRowH%2 == 0) triaglePos++;
				}*/

        x = (half/-2) + half * (1+n%((boardRowV)*2));
        y = size * Math.floor(n/((boardRowV)*2));

				triaglePos++;
				//bumpsCount++;

				if(triaglePos%2) return 'M ' + x + ' ' + (y + size) + ' l ' + half + ' -' + size + ' l -' + size + ' 0 z';
				else return 'M ' + x + ' ' + y + ' l ' + half + ' ' + size + ' l -' + size + ' 0 z';

				//M 100 100 L 300 100 L 200 300 z
      });

			var size = getTileSize();
			var half = size/2;

			for(var j = 0; j <= Math.floor(bumps / 2); j++) {

				var n = bumpsCount + data.length;
				if(n%boardRowH == 0 && boardRowH%2 == 0) triaglePos++;

				var x = (half/-2) + half * (1+n%((boardRowV)*2));
				var y = size * Math.floor(n/((boardRowV)*2));
				var draw = "";

				triaglePos++;
				bumpsCount++;

				if(triaglePos%2) draw = 'M ' + x + ' ' + (y + size) + ' l ' + half + ' -' + size + ' l -' + size + ' 0 z';
				else draw = 'M ' + x + ' ' + y + ' l ' + half + ' ' + size + ' l -' + size + ' 0 z';

				grindex.append('path')
        .attr('d', draw)
        .attr('stroke', '#fff')
        .attr('stroke-width', 'thin');
			}

			if(boardRowH%5 == 1) {
				for(var i = 1; i < boardRowV; i++) {
					grindex.insert('path', ':nth-child('+(boardRowH*i)+')');
				}
			}

			// grindex.each(function(d, i) {
			// 	d3.select(this)
			// 	.append("div").exit()
			// 	.append("div")
			// 	.insert("div", ":first-child")
			// })
			//grindex.append("span")
			//grindex.insert("span", ":first-child")

	// d3.select(".grindex ul")
	// 	.styles({
	// 		"margin-left":getTilePosition,
	// 		"margin-right":getTilePosition,
	// 		"overflow":"hidden",
	// 	})
  // 	.selectAll("a")
  // 	.data(data)
  // 	.enter()
	// 	.append("li")
	// 	.styles({
	// 		// "animation-delay":function(d) { return d3.randomUniform(-180, 0)() + "s"; },
	// 		// "animation-duration":function(d) { return d3.randomUniform(30, 180)() + "s"; },
	// 		// "animation-direction":function(d) { return (d3.randomUniform(0, 1)() > 0.5) ? "auto" : "reverse"; },
	// 		"width":getTileSize,
	// 		"height":getTileSize,
	// 		"margin-left":getTilePosition,
	// 		//"margin-right":getTileSize,
	// 	})
	// 	// .each(function(d, i) {
	// 	// 	var isBump = (Math.random() < 0.75 && bumpsCount < bumps && (i+bumpsCount)%boardRow != boardRow-1);
	// 	// 	var isBumpRight = (isBump && Math.random()>0.5);
	// 	// 	console.log(i + ", " + bumpsCount + " - " + (i+bumpsCount)%boardRow);
	// 	// 	d3.select(this)
	// 	// 	.classed("variant-" + Math.round(d%3), true)
	// 	// 	.classed("bump-left", (isBump && !isBumpRight))
	// 	// 	.classed("bump-right", isBumpRight);
	// 	// 	if(isBump) bumpsCount++;
	// 	// })
	// 	.styles({
	// 		// "animation-delay":function(d) { return d3.randomUniform(-100, 0)() + "s"; },
	// 		// "margin-top":getTilePosition,
	// 		// "margin-left":getTilePosition,
	// 		// "transform":getTileInnerPosition,
	// 	})
	// 	.append("svg")
	// 	.attr("viewBox", "0 0 100 100")
	// 	.append("a")
	// 	.attr("href", "#")
	// 	//.text(function(d) { return d; })
	// 	.append('path')
  //     .attr('d', function(d, i) {
	// 			if(i%2) {
	// 				return 'M 50 0 l 50 100 l -100 0 z';
	// 			} else {
	// 				return 'M 50 100 l 50 -100 l -100 0 z';
	// 			}
	// 			//M 100 100 L 300 100 L 200 300 z
  //     });

		function getTileSize(d) {
			var size = 1000/boardRowV;
			//size *= 100/1;
			return size;
		}

		function getTilePosition(d) {
			var size = 1000/boardRow;
			var position = size/-2;
			return position;
		}

		function getTileInnerPosition(d, i) {
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
