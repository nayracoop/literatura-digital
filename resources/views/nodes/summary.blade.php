<div class="col-lg-4 col-md-6">    
    <div class="thumbnail">
       <a href="{{ route('node.show', [$story->slug, $textNode->slug] ) }}">
        <div class="caption">
     	    <h3>{{ $textNode->title }}</h3>
       		<p>{{ $textNode->text }}</p>
        </div>
        </a>
    </div>
</div>