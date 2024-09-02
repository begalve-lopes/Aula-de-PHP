<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\LoginController;
use App\Mail\SeriesCreated;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::resource('series',SerieController::class)->except('show');
Route::middleware('auth')->group(function(){
    Route::get('/', function () {
        return redirect('/series');
    });

    Route::get('/series/{series}/seasons',[SeasonsController::class,'index'])->name('seasons.index');

    Route::get('/seasons/{season}/episodes',[EpisodesController::class,'index'])->name('episodes.index');
    Route::post('/seasons/{season}/episodes',[EpisodesController::class,'update'])->name('episodes.update');

});

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store'])->name('store');
Route::post('/logout',[LoginController::class,'destroy'])->name('logout');
Route::get('/Registo',[UsersController::class,'create'])->name('Registar.create');
Route::post('/Registo',[UsersController::class,'store'])->name('Registar.store');

Route::get('/email',function(){
    return new SeriesCreated(
        'Seriea de teste',
        1,
        1,
        10
    );
});
