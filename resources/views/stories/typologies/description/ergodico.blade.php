<div class="fondo-forms">
    <div class="container explicacion">
        <div class="row">         
        <div class="col-sm-12">
            <a class="back-button" href="{{ URL::previous() }}">Volver</a>
            <h1>Ergódico</h1>
        </div>
        </div>
        <div class="row">

        <div class="col-sm-7">
          <p>En <strong>Lexia</strong> llamamos <strong>ergódico</strong> a cierto tipo de historias donde el lector tiene la posibilidad tomar decisiones sobre las acción que desarrollan los personajes y de esa manera modificar el curso del relato. <strong>Ergódico</strong> viene de las palabras griegas <b><i>ergon</i></b> (trabajo) y <b><i>hodos</i></b> (camino) .</p>

        <div class="figure tam-33">
          <img src="{{ asset('img/home/elige.jpg') }}" alt="" class="borde">
        </div>

        <p>Este tipo de libros fue muy popular en los años 80 y 90s. Se calcula que la colección <strong>"Elige Tu Propia Aventura"</strong> llegó a vender más de 260 millones de ejemplares en todo el mundo. Las historias recorren distintos géneros como el misterio, las aventuras o la ciencia ficción y han dado en versiones más especializadas como las colecciones dedicadas al mundo de los videojuegos o las aventuras del joven Indiana Jones. El estudio Twentieth Century Fox está trabajando en adaptaciones al cine de los libros originales que usará la tecnología de streaming <i>CtrlMovie</i> una herramienta especialmente diseñada para ofrecer distintas opciones de recorrido sin entorpecer la experiencia regular de ver un film.</p> 

        <p>Los <strong>"Elige Tu Propia Aventura"</strong> presentan relatos escritos en segunda persona: hay un narrador que usa el <i>tú</i> para dirigirse a sus lectores, los verdaderos protagonistas de la historia. Se leen como cualquier libro normal hasta cierto punto en el que unas preguntas obligan al lector a tomar decisiones sobre qué camino recorrer.</p>

        <div class="figure">
          <img src="{{ asset('img/home/elige-opciones.jpg') }}" alt="" class="borde">
          <p class="epigrafe">Ejemplo de cómo se muestran las opciones para seguir distintos caminos en el relato</p>  
        </div>

        <p>La propuesta es parecida a la de un juego donde el objetivo es llegar a una serie de finales <i>buenos</i> o satisfactorios en los cuales el protagonista logran escapar de un peligro o alcanzan a resolver un misterio.</p>

        <div class="figure tam-50">
          <img src="{{ asset('img/home/elige-final.png') }}" alt="" class="borde">  
        </div>

        <p>Hay una segunda especie de finales <i>malos</i> que la mayoría de las veces terminan con la muerte del protagonista.</p>

        <p>Por último están los finales insulsos. No son ni una cosa ni la otra: el personaje no muere, pero tampoco llega al final del misterio planteado al inicio del libro.</p>

        <p class="clear">Una buena manera de diseñar tus relatos es por medio de estos árboles de navegación. La visualización en conjunto de todos los nodos de tu relato permiten por ejemplo tener una dimensión clara de cuáles son los puntos en los que la historia se ramifica en varias direcciones. Al mismo tiempo podés medir el equilibro que existe entre los distintos tipos de final.</p>

        <div class="figure">
          <img src="{{ asset('img/home/elige-arbol.png') }}" alt="" class="borde">
          <p class="epigrafe">Arbol de navegación de uno de los libros de la colección <strong>"Elige Tu Propia Aventura"</strong>. Los distintos tipos de final aparecen en verde, rojo o amarillo.</p>  
        </div>


          <div class="empeza">
            <a href="{{ route('register') }}" class="btn">¡Empezá a escribir!</a>
          </div>

        </div>

        <div class="col-sm-4  col-sm-offset-1 modelos">

        <div class="podra">
            <h2>Tu relato se verá de esta manera</h2>
            <hr />
        </div>
        
        <div class="figure">
          <img src="{{ asset('img/home/ejemplo-ergodico.png') }}" alt="">
        </div>
        
        </div>

        </div>
    </div>
</div>