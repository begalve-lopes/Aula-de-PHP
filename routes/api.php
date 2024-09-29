<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Whoops\Handler\PlainTextHandler;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('/series',\App\Http\Controllers\Api\SeriesCOntroller::class);

    Route::GET('/series/{series}/seasons', function(\App\Models\Serie $series) {
        return $series->seasons;
    });

    Route::GET('/series/{series}/episodes', function(\App\Models\Serie $series) {
        return $series->episodes;
    });

    Route::PATCH('/episodes/{episode}',function(\App\Models\Episode $episode,Request $request){
        $episode->watched=$request->watched;
        $episode->save();
        return  $episode;
    });

    Route::post('/user',[UserController::class,'index']);
});

Route::POST('/login',[AuthController::class,'login']);
Route::POST('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
Route::get('/me',[AuthController::class,'me'])->middleware('auth:sanctum');
