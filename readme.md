# Literatura digital

Literatura digital es una web que permitirá escribir relatos con diferentes estructuras a partir de nodos de texto.

## Tipologias

Las tipologías (Typology/ies) definen los tipos de relatos:

* Temporal

Orden cronológico de los text nodes (es un orden que eventualmnte dejaríamos alterar al usuario, pero cambiando la fecha de publicación o algo así)

* Lineal

Pensado para un relato tradicional y para los ensayos de tipo asociativo. Debería dar la posibilidad de establecer un orden, por lo que por ahí cada story va a tener asociado un array de orden (o cualquier otra forma que crean mejor de alojar ese orden)

* Episódico

a nivel de estructura es igual a la lineal (aunque en el frontend editor/lectura se muestren diferente o se puedan randomizar, etc.). Nodos reordenables.

* Rizomica / ergodica / CYOA

Esta es quizás la estructura más compleja desde el front-end y la dejaría para el final. Como ya hay herramientas solo para hacer relatos del tipo elige tu propia aventura es quizás la menos novedosa y las que menos me preocupa. Aunque quizás no es tan complejo a nivel backend y se puede definir la relación entre los nodos aunque después no la usemos.

Acá la relación de cada nodo sería uno a muchos:

Un nodo puede relacionarse a ninguno/uno/N nodos

una tabla debería guardar estas relaciones y permitirles un orden de relacion para que después el front-end pueda recuperar facil el orden que el usuario definio para los links.

* Coral

Acá cada nodo pertenecería a una "voz" o "personaje", entonces es parecida a los episodios, pueden reordenarse, pero a su vez cada nodo va a tener un color particular de acuerdo al personaje que lo contenga.



## La visión de José

> Considero oportuno crear una carpeta de vistas con snippets propios de las tipologias dentro de la carpeta *tipologies*. A su vez divididos en tres carpetas:
> * node_fields : campos de formulario en la creación de fragmento
> * node_links : Enlaces a otros nodos del mismo relato. vista de nodo
> * node_presentation : presentación de los fragmentos en la vista de Relato 
>
>
> Después podemos debatir si realizamos mejoras en la lógica de presentación dentro de los modelos (Story & TextNode)


Estos archivos de snippet tienen el nombre slug de la tipología y se llaman con el código: ```@include('typologies.node_links.'.$story->typology)   ```

### Ventajas

Las vistas generales de Relato y Fragmento serán las mismas independiente de la tipología

### Desventajas

Hay que generar un archivo para cada tipo de relato en cada carpeta.