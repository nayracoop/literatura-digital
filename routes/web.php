<?php

use Illuminate\Http\Request;

/*
* Web Routes
*/

#home
Route::get('/', 'StoryController@index')->name('index');

#vista pública de autor
Route::get('/autor/{slug}', 'UserController@author')->name('author.show');
#formulario público de contacto
Route::get('/contacto', 'AdminController@listCategories')->name('contact');

#relatos y nodos de acceso público
Route::group(['prefix' => 'relatos'], function () {
    #lista general de relatos. Con búsqueda, en desuso
    Route::get('/', 'StoryController@stories')->name('stories');

    Route::get('/genero/{genre?}', 'StoryController@searchByGenre')->name('stories.genre');
    Route::post('/genero', 'StoryController@searchByGenre')->name('stories.search-by-genre');

    Route::post('/busqueda', 'StoryController@search')->name('stories.search');
    Route::get('/{slug}', 'StoryController@show')->name('story.show');
    Route::get('/{slug}/fragmentos/{slugNode}', 'StoryController@showNode')->name('node.show');
});

#acciones exclusivas de usuarios
Route::group(['middleware' => 'auth'], function () {
    #like para relato ó fragmento
    Route::post('/favoritos/{story}/{node?}', 'StoryController@like')->name('like');
    #like pero para users
    Route::post('/seguir/{username}', 'UserController@follow')->name('follow');
    #dejar comentario en relato
    Route::post('/relatos/{slug}/comentar', 'StoryController@storeComment')->name('comment.store');
    #dejar comentario en autor
    Route::post('/autor/{slug}/comentar', 'UserController@storeComment')->name('comment.author.store');
});

# perfil de usuario
Route::group(['middleware' => 'auth', 'prefix' => 'mi-perfil'], function () {
    Route::get('/', 'UserController@myProfile')->name('author.edit');
    Route::patch('/', 'UserController@updateProfile')->name('author.update');
});

Route::group(['middleware' => 'auth', 'prefix' => 'mis-relatos'], function () {
    # lista de relatos
    Route::get('/', 'StoryController@myStories')->name('my-stories');
    
    # crear relato
    Route::get('/nuevo', 'StoryController@createStory')->name('story.create');
    Route::post('/nuevo', 'StoryController@storeStory')->name('story.store');

    # editar relato
    Route::get('/{slug}/editar', 'StoryController@editStory')->name('story.edit');
    Route::patch('/{slug}/editar', 'StoryController@updateStory')->name('story.update');

    # crear nodos de un relato
    Route::get('/{slug}/nuevo-fragmento', 'StoryController@createNode')->name('node.create');
    Route::post('/{slug}/nuevo-fragmento', 'StoryController@storeNode')->name('node.store');
    Route::get('/{slug}/fragmentos', 'StoryController@nodes')->name('story.nodes');
    Route::get('/{slug}/fragmentos/{slugNode}/editar', 'StoryController@editNode')->name('node.edit');

    # guardar relato
    Route::post('/save-story', 'StoryController@saveStoryXhr')->name('save-story');
    Route::post('/save-node', 'StoryController@saveNodeXhr')->name('save-node');

    # guardar imagen
    Route::post('/store-picture', 'StoryController@storePictureXhr')->name('store-picture');
});

#acciones exclusivas de admin
Route::group(['middleware' => 'auth.admin', 'prefix' => 'admin'], function () {
    Route::get('/usuarios', 'AdminController@listUsers')->name('admin.users');
    Route::get('/labels', 'AdminController@listLabels')->name('admin.labels');
    Route::get('/categories', 'AdminController@listCategories')->name('admin.categories');
    Route::post('/relatos/publicar', 'StoryController@changeStatus')->name('story.change-status');
});

Route::get('/salir', function () {
    if (Auth::check()) {
        Auth::logout();
    }
    return redirect()->route('index');
})->name('salir');

Auth::routes();
