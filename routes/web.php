<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

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

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get( '/', [ HomeController::class, 'index' ] )->name( 'dashboard' )->middleware(['auth', 'verified']);

//Route::get('/home', function (){
//
//    return view('dashboard');
//
//   //dd(\Illuminate\Support\Facades\Auth::user());
//})->middleware(['auth', 'verified']);
