<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;


Route::Post('/register',[UsersController::class,"register"]);
Route::Post('/login',[UsersController::class,"login"]);



Route::group([
    "middleware"=>["auth:sanctum"]



], function () {

    Route::get('/profile',[UsersController::class,"getProfile"]);
    Route::post('/user-profile',[UsersController::class,"updateProfile"]);
    Route::get('/user-details',[UsersController::class,"userDetails"]);
    Route::get('/logout',[UsersController::class,"logout"]);
    
});
