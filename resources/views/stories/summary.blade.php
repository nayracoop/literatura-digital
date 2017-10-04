 <div class="col-lg-3 col-sm-6">
        <div class="thumbnail">
          <div class="caption">
            <div class="media-item">
              <img alt="" src="./Escrituras digitales_files/tapa150x200.png">
            </div>
            <h3>{{$story->title}}</h3>
            <p class="lead">De <a href="http://bardo.surwww.com/usuario.html">Mike Wilson</a></p>
            <p>{{ $story->description }}</p>

            <a href="http://bardo.surwww.com/home.html#">Ciencia Ficción</a>
            <div>
              <span>Visto: 71.9K</span>
              <span>Likeado: 3.2K</span>      
              <span>Partes: 58</span>
            </div>   

            <p><a href="{{ route('story.show', $story->slug ) }}" class="btn btn-primary">Leer!</a></p>
          </div>
        </div>
</div>