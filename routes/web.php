<?php

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

// Route::get('/', 'GameController@view')->name('game');
// // Route::get('/', function() {
// //     return view('index');
// // })->name('baseView');

Route::get('/' , App\Http\Livewire\Game::class);
Route::get('/game' , App\Http\Livewire\Game::class);
