<?php

use Illuminate\Http\Request;

/*
* Web Routes
*/

#home
Route::get('/', 'StoryController@index')->name('index');

#vista pública de autor
Route::get('/autor/{user}', 'UserController@show')->name('user.show');
#formulario público de contacto
Route::get('/contacto', 'AdminController@listCategories')->name('contact');

#relatos y nodos de acceso público
Route::group(['prefix' => 'relatos'], function () {
    #lista general de relatos. Con búsqueda, en desuso
    Route::get('/', 'StoryController@stories')->name('stories');

    Route::get('/genero/{genre?}', 'StoryController@searchByGenre')->name('stories.genre');
    Route::post('/genero', 'StoryController@searchByGenre')->name('stories.search-by-genre');

    Route::post('/busqueda', 'StoryController@search')->name('stories.search');
    Route::get('/{story}', 'StoryController@show')->name('story.show');
    Route::get('/{story}/fragmentos/{textNode}', 'TextNodeController@show')->name('node.show');
});

#acciones exclusivas de usuarios hacia otros relatos
Route::group(['middleware' => 'auth'], function () {
    #like para relato ó fragmento
    Route::post('/favoritos/{story}/{textNode?}', 'StoryController@like')->name('like');
    #like pero para users
    Route::post('/seguir/{username}', 'UserController@follow')->name('follow');
    #dejar comentario en relato
    Route::post('/relatos/{story}/comentar', 'StoryController@storeComment')->name('comment.store');
    #dejar comentario en autor
    Route::post('/autor/{story}/comentar', 'UserController@storeComment')->name('comment.user.store');
});

# perfil de usuario
Route::group(['middleware' => 'auth', 'prefix' => 'mi-perfil'], function () {
    Route::get('/', 'UserController@edit')->name('user.edit');
    Route::patch('/', 'UserController@update')->name('user.update');
});

Route::group(['middleware' => 'auth', 'prefix' => 'mis-relatos'], function () {
    # lista de relatos
    Route::get('/', 'StoryController@list')->name('stories.list');

    # crear relato
    Route::get('/nuevo', 'StoryController@create')->name('story.create');
    Route::post('/nuevo', 'StoryController@store')->name('story.store');

    # editar relato
    Route::get('/{story}/editar', 'StoryController@edit')->name('story.edit');
    Route::patch('/{story}/editar', 'StoryController@update')->name('story.update');

    # crear nodos de un relato
    Route::get('/{story}/nuevo-fragmento', 'TextNodeController@create')->name('node.create');
    Route::post('/{story}/nuevo-fragmento', 'TextNodeController@store')->name('node.store');

    Route::get('/{story}/fragmentos', 'TextNodeController@index')->name('nodes.index');
    Route::get('/{story}/fragmentos/{textNode}/editar', 'TextNodeController@edit')->name('node.edit');
    Route::patch('/{story}/fragmentos/{textNode}/editar', 'TextNodeController@update')->name('node.update');

    # guardar relato nuevo o editar por Xhr
    Route::post('/save-story', 'StoryController@saveStoryXhr')->name('story.saveXhr');
    # guardar nodo nuevo o editar por Xhr
    Route::post('/save-textNode', 'TextNodeController@saveNodeXhr')->name('node.saveXhr');
    # guardar imagen
    Route::post('/store-picture', 'StoryController@storePictureXhr')->name('picture.storeXhr');
});

#acciones exclusivas de admin
Route::group(['middleware' => 'auth.admin', 'prefix' => 'admin'], function () {
    Route::get('/usuarios', 'UserController@index')->name('users.index');
    Route::get('/usuarios/{user}/editar', 'UserController@edit')->name('admin.user.edit');
    Route::patch('/usuarios/{user}/editar', 'UserController@update')->name('admin.user.update');

    Route::get('/usuarios/nuevo', 'UserController@create')->name('admin.user.create');
    Route::post('/usuarios/nuevo', 'UserController@store')->name('admin.user.store');

    Route::get('/etiquetas', 'TagController@index')->name('tags.index');
    Route::get('/categories', 'CategoryController@index')->name('admin.categories');
    Route::post('/relatos/publicar', 'StoryController@changeStatus')->name('story.change-status');
});

Route::get('/salir', function () {
    if (Auth::check()) {
        Auth::logout();
    }
    return redirect()->route('index');
})->name('salir');

Auth::routes();

Route::get('/etiqueta/{tag}', 'StoryController@storiesByTag')->name('tag.stories');
