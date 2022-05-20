<?php

use App\Http\Controllers\{PostController, CategoryController, TagController};
use App\Models\{Post, User, Category};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $posts=Post::where('estado', 'PUBLICADO')->orderBy('id', 'desc')->paginate(5);
    return view('welcome', compact('posts'));
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('prueba', function(){
    //$user=User::where('email', 'pacofer71@gmail.com')->first();
    //$posts = $user->posts->where('estado', 'PUBLICADO');
    //$post=Post::find(4);
    //$user = $post->user;
   // return $user;
   //return $post->tags;
   $post=Post::find(12);
    //return $post->tags;
   return $post->tags->contains('id', 3)? "SI": "NO";

});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->resource('posts', PostController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->resource('categories', CategoryController::class);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->resource('tags', TagController::class);
