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
    return redirect(route('home'));
});
Route::get('/home', function (){
    return view('home');
})->name('home');

Route::name('user.')->group(function (){

    Route::get('/registration', function (){
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('registration');
    })->name('registration');

    Route::post('/registration', [\App\Http\Controllers\UserController::class, 'registration']);

    Route::get('/login', function (){
        if (Auth::check()) {
            return redirect(route('home'));
        }
        return view('login');
    })->name('login');

    Route::post('/login', [\App\Http\Controllers\UserController::class, 'login']);

    Route::get('/logout', function (){
        Auth::logout();
        return redirect(route('home'));
    })->name('logout');
});
