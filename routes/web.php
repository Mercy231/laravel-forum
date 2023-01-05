<?php

use Illuminate\Support\Facades\Auth;
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
    return redirect('home');
});
Route::get('/home', [\App\Http\Controllers\PostController::class, 'postsShow'])->name('home');

Route::name('user.')->group(function (){

    Route::get('/registration', [\App\Http\Controllers\UserController::class, 'registrationShow'])
        ->name('registration');

    Route::post('/registration', [\App\Http\Controllers\UserController::class, 'registration']);

    Route::get('/login', [\App\Http\Controllers\UserController::class, 'loginShow'])
        ->name('login');

    Route::post('/login', [\App\Http\Controllers\UserController::class, 'login']);

    Route::get('/logout', function (){
        Auth::logout();
        return redirect('home');
    })->name('logout');

    Route::get('/createPost', [\App\Http\Controllers\PostController::class, 'createPostShow'])
        ->name('createPost');

    Route::post('/createPost', [\App\Http\Controllers\PostController::class, 'createPost']);

    Route::get('/editPost/{id}', [\App\Http\Controllers\PostController::class, 'editPostShow'])
        ->name('editPost');
    Route::post('editPost/{id}', [\App\Http\Controllers\PostController::class, 'editPost']);

    Route::get('/deletePost/{id}', [\App\Http\Controllers\PostController::class, 'deletePost'])
        ->name('deletePost');
});
