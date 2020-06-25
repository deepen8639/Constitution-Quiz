<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/chapter', 'ConstitutionController@returnChapter');
Route::get('/provision', 'ConstitutionController@returnProvision');

// Route::get('/quiz/{chapter_id}', 'ConstitutionController@quiz');
Route::get('/user_custom_quiz/{user_id}', 'ConstitutionController@returnUserCustomQuiz');
Route::put('/user_correctness', 'ConstitutionController@updateUserCorrectness');
Route::get('/user_correctness/{user_id}', 'ConstitutionController@returnUserCorrectness');
