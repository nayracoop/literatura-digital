<?php
use Illuminate\Http\Request;
/*
* Web Routes
*/
#home
Route::get('/', 'StoryController@index')->name('index');
#relatos y nodos 
Route::get('/relatos', 'StoryController@index')->name('story.index');
#edicion relatos nodos
Route::get('/relatos/nuevo', 'StoryController@createStory')->name('story.create');
Route::post('/relatos/nuevo', 'StoryController@storeStory')->name('story.store');


Route::get('/relatos/{slug}', 'StoryController@show')->name('story.show');
#dejar comentario
Route::post('/relatos/{slug}/comentar','StoryController@storeComment')->name('comment.store');
Route::post('/autor/{slug}/comentar','UserController@storeComment')->name('comment.author.store');
//crear nodos de un relato
Route::get('/relatos/{slug}/nuevo-fragmentos','StoryController@createNode')->name('node.create');
Route::post('/relatos/{slug}/nuevo-fragmentos','StoryController@storeNode')->name('node.store');
Route::get('/relatos/{slug}/fragmentos/{slugNode}', 'StoryController@showNode')->name('node.show');


#perfil-usuario
Route::get('/mi-perfil', 'UserController@profile')->name('author.edit');
Route::patch('/mi-perfil', 'UserController@updateUrofile')->name('author.update');
#vista publica de autor
Route::get('/autor/{slug}', 'UserController@author')->name('author.show');




Route::get('/salir', function(){
    if(Auth::check()){
        Auth::logout();
    }
    return redirect()->back();
})->name('salir');



# Controlador de pruebas
Route::get('/delete-user','TestController@deleteUser');
Route::get('/list-users','TestController@listUsers');
Route::get('/list-user-stories','TestController@listUserStories');

#rutas temporales para pruebas
/*
Route::get('/save', function(){
    $a = new \App\Models\Story();
    $a->title = 'hola Mongo';
    $a->save();
});

Route::get('/save-nodes', function(){
    $a =  \App\Models\Story::where('slug', 'macri-gato')->first();

    //---
    $tn1 = new \App\Models\TextNode(['title' => 'A','text' => 'hfuiwjgk gyugu ghugdf', 'image'=> 'default.jpg','title' => 'published_at' ]);
    $tn2 = new \App\Models\TextNode(['title' => 'A','text' => 'hfuiwjgk gyugu ghugdf', 'image'=> 'default.jpg','title' => 'published_at' ]);

    //---
    $a->textNodes()->save($tn1) ;
    $a->textNodes()->save($tn2) ;
    $a->save();
});

Route::get('/stories', function(){
    $stories =  \App\Models\Story::all();
    foreach ($stories as $s) {
        echo "<br>$s->title - $s->description";
        # code...
    }
})->name('stories');

Route::get('/new-story', function(){    
    return view('nodes.create_story');
})->name('story.create');


Route::post('/new-story', function(Request $request){
    $input = $request->all();
    $story =  new \App\Models\Story();
    $story->create($input);
    
    return redirect()->route('stories');
})->name('story.store');
*/
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
