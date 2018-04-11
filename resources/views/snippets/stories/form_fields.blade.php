<div class="col-md-8">
        <div class="form-padding-interno">
            {{--  TITULO  --}}
            <label for="nombre">@lang('messages.title') *</label>
            <input type="text" class="form-control" id="titulo" name="title" value="{{$story->title or ''}}">

            {{--  DESCRIPCION  --}}
            <label for="mensaje">@lang('Descripción') *</label>
            <textarea class="form-control" id="mensaje" name="description">{{$story->description or ''}}</textarea>

            <div class="row">
                <div class="col-md-6">
                    {{--  TIPOLOGÍA  --}}
                    <label for="genero">@lang('messages.typology') *</label>
                    <div class="styled-select">
                        <select type="text" class="form-control" id="typology" name="typology" data-url="{{ route('typology.visualizations') }}">
                        @foreach($typologies as $typology)
                            <option value="{{ $typology->_id }}"
                                @if (isset($story) && !empty($story->typology) && $story->typology === $typology->_id)
                                    selected
                                @endif>
                                {{ ucfirst($typology->name) }}
                            </option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    {{--  GÉNERO  --}}
                    <label for="genero">@lang('messages.gender') *</label>
                    <div class="styled-select">
                        <select type="text" class="form-control" id="genero" name="genre">
                            @foreach(\App\Models\Genre::all() as $genre)
                                <option value="{{$genre->slug}}"
                                    @if (isset($story) && !empty($story->genre) && $story->genre === $genre->slug)
                                        selected
                                    @endif>
                                    {{ $genre->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{--  VISUALIZACIÓN  --}}
            <label for="genero">@lang('messages.visualization') *</label>
            <div class="styled-select">
                <select type="text" class="form-control" id="visualization" name="visualization">
                    @foreach($visualizations as $visualization)
                        <option value="{{ $visualization->_id }}"
                            @if (isset($story) && !empty($story->visualization) && $story->visualization === $visualization->_id)
                                selected
                            @endif>
                            {{ ucfirst($visualization->name) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        {{--  IMAGEN DE PORTADA  --}}
        <label for="portada">@lang('messages.story_cover')</label>
        <div class="portada-border">
            @if (isset($story) && $story->cover != null && !empty($story->cover))
                <img alt="@lang('messages.cover_for') {{$story->title}}" src="{{ asset('imagenes/cover/' . $story->cover) }}">
            @else
                <img alt="" src="{{ asset('img/img-relato-default.jpg')}}">
            @endif
        </div>
        <input type="file" class="form-control portada-archivo" name="cover_drag" id="portada">

        {{--  ETIQUETAS  --}}
        <h2>@lang('messages.tags')</h2>
        <div class="tag-group">
            @if (isset($story))
                @foreach ($story->tags as $tag)
                    <div class="tag-item">
                        <p>{{ $tag->name }}</p>
                        <button>@lang('messages.delete_tag')</button>
                        <input type="hidden" name="tags[]" value="{{ $tag->name }}"/>
                    </div>
                @endforeach
            @endif
        </div>
        <label for="tag" class="more-tags-title">@lang('messages.add_tag'):</label>
        <input type="text" class="form-control more-tags-input" id="tag" />
        <button type="button" id="add_tag" class="more-tags-bot">@lang('messages.add_tag')</button>
    </div>

    {{--  ID DE LA HISTORIA  --}}
     @if (isset($story))
    <input type="hidden" name="id" value="{{ $story->_id }}"/>
    <input type="hidden" name="story" value="{{ $story->_id }}"/>
    @endif
    {{--  Status  --}}
    <input type="hidden" name="status" value="@if (isset($story)) {{ $story->status }} @else {{ \App\Models\Enums\Status::DRAFT }} @endif"/>
    {{-- Step para pasarselo al nodo --}}
    <input type="hidden" name="step" value="{{ $step or '1'}}"/>
    