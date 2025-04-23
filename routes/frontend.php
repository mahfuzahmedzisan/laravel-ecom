<?php

use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Route;


Route::group(['as' => 'f.'], function () {
  Route::get('/', [FrontendController::class, 'home'])->name('home');
});
