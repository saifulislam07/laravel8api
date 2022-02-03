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
Route::patch('/update-single-record/{id}', [UserApiController::class, 'updateSingleRecord']);
Route::delete('/delete-single-record/{id}', [UserApiController::class, 'deleteSingleRecord']);
Route::delete('/delete-single-record-by-json', [UserApiController::class, 'deleteSingleRecordByJson']);
Route::delete('/delete-multiple-record/{ids}', [UserApiController::class, 'deleteMultipleRecord']);
Route::delete('/delete-multiple-record-by-json', [UserApiController::class, 'deleteMultipleRecordByJson']);
