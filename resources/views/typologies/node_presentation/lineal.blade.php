<style>

   .ejemplo{
     max-width: 500px;
     width: 90%;
     margin: 80px auto 80px auto;
    }

   .ejemplo a {
     display: block;
     cursor: pointer;
     font: 10px sans-serif;
     background-color: steelblue;
     text-align: right;
     padding: 3px;
     margin: 1px;
     color: white;
   }
 </style>
 <div class="ejemplo"></div>
@push('javascript')
 <script src="https://d3js.org/d3.v4.min.js"></script>
   <script>
@php
$nodes = [];
foreach ( $story->textNodes->sortBy('order') as $textNode ) {
    $charCount [] = $textNode->charCount !== null ? $textNode->charCount : 0 ;
    $nodes [] = $textNode;
}
$nodes = json_encode($nodes);
$charCount = json_encode( $charCount);
@endphp
     var data = {!!$nodes!!};
     var x = d3.scaleLinear()
         .domain([0, d3.max({!! $charCount !!})])
         .range([0, 100]);
     d3.select(".ejemplo")
       .selectAll("div")
         .data(data)
       .enter().append("a")
         .style("width", function(d) { return x(d.charCount) + "%"; })
         .text(function(d) { return d.charCount; })
         .attr('id',function(d) { return d._id; })
         .attr('href',function(d) { return '#ventana-nodo-'+d._id; })
         .attr('class','leer');
</script>
@endpush
