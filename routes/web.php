<?php

use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Route;

Route::get("/",[PageController::class,'home'])->name('home');
Route::post("/request-event",[PageController::class,'request_event'])->name('request_event');
Route::get('/event/{id}',[PageController::class,'event'])->name('event');
Route::get('/category/{slug}',[PageController::class,'category'])->name('category');


