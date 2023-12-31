<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;



Route::post('/signin', [AuthController::class, 'signIn']);
Route::post('/signup', [AuthController::class, 'signUp']);


// Route::group(["middleware" => "auth:api"], function(){
//     $user = Auth::user(); 


// });

Route::get('/contact-list', [UserController::class, 'getContactList']);
Route::post('/create-contact', [UserController::class, 'createContact']);



Route::get("unauthorized", [AuthController::class, "unauthorized"])->name("unauthorized");


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});






