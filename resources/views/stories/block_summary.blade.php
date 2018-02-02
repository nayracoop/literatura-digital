<article class="col-sm-12 col-md-6">
    <div class="card"> 
        <a href="{{ route('story.show', $story->slug ) }}">

            @if ($story->cover != null && !empty($story->cover))
                <img alt="@lang('tapa de') {{ $story->title }}" src="{{ asset('imagenes/cover/'.$story->cover )}}">        
            @else
                <img alt="" src="{{ asset('img/img-3.jpg')}}"> 
            @endif
            
            <h3>{{ $story->title or __('messages.no_title') }}</h3>

            @if (isset($story->author))
                @php $authorName = $story->getAuthorName(); @endphp
                <p class="autor-relato"><a href="{{ route('user.show', $story->author->username) }}">{{ $authorName or __('messages.user_no_name') }}</a></p>
            @else
                <p class="autor-relato"><a>@lang('messages.deleted_user')</a></p>
            @endif

            <span><hr /></span>

            <p class="resumen">{{ $story->description or __('messages.no_description') }}</p>

            @auth
                @php
                    $user = auth()->user();
                    $checked = '';
                    if ($story->status == \App\Models\Enums\StoryStatus::PUBLISHED) {
                        $checked = 'checked=\"checked\"';
                    }
                @endphp
                
                @if ($user->isAdminOrMod())
                    <input type="checkbox" name="publish_status" {{ $checked }} class="status_switch" id="{{ $story->id }}">
                @endif
            @endauth

            <span class="ver-mas"></span>
        </a>
    </div>  
</article>