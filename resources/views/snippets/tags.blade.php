<div>
    @foreach(\App\Models\Tag::featured() as $tag)
        <a href="{{route('tag.stories',$tag->name)}}" >{{$tag->name}}</a>
    @endforeach
</div>
