<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('students')->group(function () {
    Route::post('/', 'StudentController@get');
    Route::post('/add', 'StudentController@add');
});

Route::prefix('grades')->group(function () {
    Route::post('/{student_id}/get', 'GradeController@get');
    Route::post('/{student_id}/add', 'GradeController@add');
});