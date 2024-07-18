<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register',[Controller::class,'register'])->name('register');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/index',[Controller::class,'index'])->name('index')->middleware('auth:sanctum');;
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  //  Route::get('/index',[Controller::class,'index'])->name('index');
   Route::get('/show',[Controller::class,'showMovie'])->name('create');
   Route::get('/getDirectors',[Controller::class,'findDirectors'])->name('getDirectors');
   Route::get('/getActors',[Controller::class,'findActor'])->name('getMovies');
   Route::get('/findGenres',[Controller::class,'findGenres'])->name('findGenres');
   Route::get('/movieRating',[Controller::class,'movieRating'])->name('movieRating');
});
