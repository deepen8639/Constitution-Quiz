<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function(){return redirect('/Constitute');});
// Route::get('/Constitute', 'ConstituteController@index');
// Route::post('/input/constitution', 'InputController@inputConstitution');
// Route::post('/input/chapter', 'InputController@inputChapter');
// Route::get('/input', 'InputController@index');
// Route::get('/quiz', 'QuizController@ChapterQuiz');
// Route::post('/quiz', 'QuizController@ChapterQuiz');
Route::get('/{any}', function(){
  return view('app');
})->where('any','.*');
Auth::routes();
