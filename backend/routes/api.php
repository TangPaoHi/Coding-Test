<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::get('/items',[ItemController::class,'index']);
Route::post('/items',[ItemController::class,'create']);
Route::delete('/items/{id}',[ItemController::class,'destroy']);