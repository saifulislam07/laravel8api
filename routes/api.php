<?php

use App\Http\Controllers\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/users/{id?}', [UserApiController::class, 'showUser']);
Route::post('/add-user', [UserApiController::class, 'addUser']);
Route::post('/add-multiple-user', [UserApiController::class, 'addMultipleUser']);
Route::put('/update-user-details/{id}', [UserApiController::class, 'updateUserDetails']);
