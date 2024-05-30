<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RapperController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\DataController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/rappers', [RapperController::class, 'list']);
Route::get('/rappers/create', [RapperController::class, 'create']);
Route::post('/rappers/put', [RapperController::class, 'put']);


Route::get('/rappers/update/{rapper}', [RapperController::class, 'update']);
Route::post('/rappers/patch/{rapper}', [RapperController::class, 'patch']);


Route::post('/rappers/delete/{rapper}', [RapperController::class, 'delete']);


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/albums', [AlbumController::class, 'list']);
Route::get('/albums/create', [AlbumController::class, 'create']);
Route::post('/albums/put', [AlbumController::class, 'put']);
Route::get('/albums/update/{album}', [AlbumController::class, 'update']);
Route::post('/albums/patch/{album}', [AlbumController::class, 'patch']);
Route::post('/albums/delete/{album}', [AlbumController::class, 'delete']);


Route::get('/genres', [GenreController::class, 'list']);
Route::get('/genres/create', [GenreController::class, 'create']);
Route::post('/genres/put', [GenreController::class, 'put']);
Route::get('/genres/update/{genre}', [GenreController::class, 'update']);
Route::post('/genres/patch/{genre}', [GenreController::class, 'patch']);
Route::post('/genres/delete/{genre}', [GenreController::class, 'delete']);

Route::get('/data/get-top-albums', [DataController::class, 'getTopAlbums']);
Route::get('/data/get-album/{album}', [DataController::class, 'getAlbum']);
Route::get('/data/get-related-albums/{album}', [DataController::class,
'getRelatedAlbums']);

