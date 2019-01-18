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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/wait-for-confirmation', 'WelcomeController@waitConfirmation')->name('wait');
Route::get('/about-us', function(){
	return view('about');
});
Route::get('/learn-more', function(){
	return view('learn');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=>'admin','middleware'=>'auth'], function(){
	Route::get('/', 'AdminController@dashboard');
    Route::resource('/users','UserController');
    Route::resource('/programs', 'ProgramController');
    Route::resource('/questions','QuestionController');
    Route::resource('/targets', 'TargetClientController');
    Route::resource('/program-questions', 'ProgramQuestionController');
    Route::get('/get-selected-program/{program}', 'ProgramQuestionController@getSelectedProgram');
	Route::patch('/users/approve/{user}', 'UserController@approveUser')->name('users.approve');
	Route::get('/programs/{program}/{barangay}/{user}', 'ProgramController@showCurrentProgram')->name('show.current.program');
});
