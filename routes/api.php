<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');


use App\Http\Controllers\RegisterController;

Route::post('/register', [RegisterController::class, 'register']);


use App\Http\Controllers\LoginController;

Route::post('/login', [LoginController::class, 'login']);


use App\Http\Controllers\ImageController;

Route::get('/image/post/{id}', [ImageController::class, 'getImage']);
Route::get('/image/logo/{id}', [ImageController::class, 'getLogo']);
Route::post('/image/upload', [ImageController::class, 'uploadImage']);


use App\Http\Controllers\EventController;

Route::get('/event/events', [EventController::class, 'AllEventData']);
Route::get('/event/featured', [EventController::class, 'FeaturedEvent']);
Route::post('/event/register', [EventController::class, 'register']);
Route::post('/event/registerUser', [EventController::class, 'AddRegisteredUserEvent']);
Route::get('/event/{id}', [EventController::class, 'EventData']);


use App\Http\Controllers\UserController;

Route::get('/user/{uid}', [UserController::class, 'UserData']);
Route::get('/get-uid/{email}', [UserController::class, 'getUidwithEmail']);
