# Literatura digital

Literatura digital es una web que permitirá escribir relatos con diferentes estructuras a partir de nodos de texto.

## Tipologias

Las tipologías (Typology/ies) definen los tipos de relatos:

* Temporal

Orden cronológico de los text nodes (es un orden que eventualmnte dejaríamos alterar al usuario, pero cambiando la fecha de publicación o algo así)

* Lineal

Pensado para un relato tradicional y para los ensayos de tipo asociativo. Debería dar la posibilidad de establecer un orden, por lo que por ahí cada story va a tener asociado un array de orden (o cualquier otra forma que crean mejor de alojar ese orden)

* Rizomica / ergodica / CYOA

Esta es quizás la estructura más compleja desde el front-end y la dejaría para el final. Como ya hay herramientas solo para hacer relatos del tipo elige tu propia aventura es quizás la menos novedosa y las que menos me preocupa. Aunque quizás no es tan complejo a nivel backend y se puede definir la relación entre los nodos aunque después no la usemos.

Acá la relación de cada nodo sería uno a muchos:

Un nodo puede relacionarse a ninguno/uno/N nodos

una tabla debería guardar estas relaciones y permitirles un orden de relacion para que después el front-end pueda recuperar facil el orden que el usuario definio para los links.


* Episódico

a nivel de estructura es igual a la lineal (aunque en el frontend editor/lectura se muestren diferente o se puedan randomizar, etc.). Nodos reordenables.

* Coral

Acá cada nodo pertenecería a una "voz" o "personaje", entonces es parecida a los episodios, pueden reordenarse, pero a su vez cada nodo va a tener un color particular de acuerdo al personaje que lo contenga.



