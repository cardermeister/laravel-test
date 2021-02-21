<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeerController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'api'],function () {
    Route::get('beers',  [BeerController::class, 'index_guest'])->name("beer-list-guest");
    Route::get('beers/{id}',  [BeerController::class, 'getBeer_guest'])->name("get-beer-by-id-guest");
    
    Route::group(['middleware'=>"IsAdmin",'prefix'=>'admin'],function () {
        Route::get('beers',  [BeerController::class, 'index'])->name("beer-list");
        Route::post('beers', [BeerController::class, 'addBeer'])->name("beer-list-add");
        Route::get('beers/{id}',  [BeerController::class, 'getBeer'])->name("get-beer-by-id");
        Route::patch('beers/{id}',  [BeerController::class, 'updateBeerByID'])->name("update-beer-by-id");
        Route::delete('beers/{id}',  [BeerController::class, 'deleteBeerByID'])->name("delete-beer-by-id");
    });
});

