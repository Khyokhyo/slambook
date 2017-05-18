<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@getLogin');

Route::get('register', 'HomeController@getRegister');

Route::post('register', 'HomeController@postRegister');

Route::post('login', 'HomeController@postLogin');

Route::get('logout', 'HomeController@logout');

Route::group(array('before' => 'auth'), function(){

	Route::get('admin', 'AdminController@getIndex');

	Route::get('index', 'HomeController@getIndex');

	Route::get('home', array('uses' => 'HomeController@getHome', 'as' => 'home'));
	Route::get('slams', array('uses' => 'HomeController@getSlams', 'as' => 'slams'));
	Route::get('postSlams/{id}', array('uses' => 'HomeController@postSlams', 'as' => 'postSlams'));

	Route::get('pages/{id}', array('uses' => 'HomeController@getPages', 'as' => 'pages'));
	Route::get('editPages/{id}', array('uses' => 'HomeController@postPages', 'as' => 'editPages'));
	Route::get('deletePages/{id}', array('uses' => 'HomeController@deletePages', 'as' => 'deletePages'));

	Route::get('editProfile', 'HomeController@getEditProfile');
	Route::put('editProfile', 'HomeController@putEditProfile');

	Route::get('search', array('uses' => 'HomeController@getSearch', 'as' => 'search'));
	Route::post('search-results',  array('uses' => 'HomeController@postSearch', 'as' => 'search-results'));

	Route::get('setQuestions', array('uses' => 'HomeController@getSetQuestions', 'as' => 'set-questions'));
	Route::post('setQuestions', array('uses' => 'HomeController@postSetQuestions', 'as' => 'set-questions'));
	Route::delete('setQuestions/{id}',array('uses' => 'HomeController@deleteQuestions', 'as' => 'set-questions'));

	Route::get('profile', array('uses' => 'HomeController@getProfile', 'as' => 'profile'));
	Route::post('profile/{id}', array('uses' => 'HomeController@postProfile', 'as' => 'profile'));

	Route::get('requests', array('uses' => 'HomeController@getRequests', 'as' => 'requests'));
	Route::get('requestProfile/{sender_id}', array('uses' => 'HomeController@getRequestProfile', 'as' => 'requestProfile'));
	Route::get('requestProfileDelete/{id}', array('uses' => 'HomeController@deleteRequests', 'as' => 'requestProfileDelete'));

	Route::get('accept/{id}/{sender_id}', array('uses' => 'HomeController@acceptRequest', 'as' => 'accept'));
	Route::get('questions/{sender_id}', array('uses' => 'HomeController@getQuestions', 'as' => 'questions'));
	Route::post('answered/{id}/{user_id}', array('uses' => 'HomeController@postAnswer', 'as' => 'answered'));
	Route::put('answerEdit/{id}/{user_id}', array('uses' => 'HomeController@putAnswer', 'as' => 'answerEdit'));

	Route::get('write/{ques_id}', array('uses' => 'HomeController@getWrite', 'as' => 'write'));
});