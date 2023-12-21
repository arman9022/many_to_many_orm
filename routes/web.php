<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\QuestionController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('courses',CourseController::class);
Route::resource('questions',QuestionController::class);