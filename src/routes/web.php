<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RapperController;
use App\Http\Controllers\AuthController;

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