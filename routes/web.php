<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    abort(404);
});

//Route::get('/', [MainController::class, 'index']);
