<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('posts',                     'PagesController@home');
// Route::get('blog/{post}',               'BlogController@show')->name('posts.show');
Route::get('etiquetas/{tag}',           'TagsController@show');
Route::get('categorias/{category}',     'CategoriesController@show');
Route::get('archivos',                  'PagesController@archive');


Route::post('messages', function(){
    return response()->json([
        'status' => 'OK'
    ]);
});