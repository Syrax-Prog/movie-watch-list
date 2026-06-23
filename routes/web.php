<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Movie;
use App\Http\Controllers\Index;

Route::any('/get_movie/{any?}/{any2?}', [Movie::class, 'get_movie']);
Route::any('/test', [Movie::class, 'test']);
Route::any('/login', [Index::class, 'index']);