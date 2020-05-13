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

Route::get('/', 'HomeController@show');


// Routes related to profile
Route::get('userprofile', 'profile@show');
Route::get('userprofile/edit', 'profile@edit');
Route::patch('userprofile', 'profile@update');

// Routes related to users
Route::get('users/{user}', 'UserController@show');

// Routes related to messages
Route::get('messages', 'MessagesController@index');
Route::get('messages/{receiver}', 'MessagesController@show');
Route::post('messages/{receiver}', 'MessagesController@store');
Route::delete('messages/{user}/{message}', 'MessagesController@delete');

// Routes related to event
Route::get('events/create', 'EventsController@create');
Route::get('events', 'EventsController@index');
Route::get('events/{event}/edit', 'EventsController@edit');
Route::get('events/{event}/{slug}', 'EventsController@show');
Route::post('events', 'EventsController@store')->name('events.store');
Route::patch('events/{event}', 'EventsController@update');
Route::delete('events/{event}', 'EventsController@destroy');

// Routes related to Event Application
Route::get('events/{event}/{slug}/applications', 'EventApplicationController@index');
Route::get('events/{event}/{slug}/apply', 'EventApplicationController@create');
Route::post('events/{event}/{slug}/apply', 'EventApplicationController@store');
Route::delete('applicants/{applicant}', 'EventApplicationController@destroy');

// Routes related to Hiring Applicant
Route::get('events/{event}/applicant/{applicant}', 'ApproveApplicantController@show');
Route::post('events/{event}/applicant/{applicant}', 'ApproveApplicantController@store');

// Routes related to admin create categories.
Route::get('categories', 'CategoryController@index');
Route::get('category/create', 'CategoryController@create');
Route::post('categories', 'CategoryController@store');
Route::delete('categories/{category}', 'CategoryController@destroy');

// Routes related to admin view all events
Route::get('viewallevents', 'ViewAllEventsController@index');
Route::delete('viewallevents/{event}', 'ViewAllEventsController@destroy');
Route::patch('viewallevents/{event}', 'ViewAllEventsController@store');

// Routes related to applied and advertised event
Route::post('events/{event}/{slug}/like', 'LikedEventController@store');
Route::get('liked-events', 'LikedEventController@index');
Route::delete('liked-events/{event}', 'LikedEventController@destroy');

// Routes related to applied and advertised event
Route::get('applied-events', 'AppliedEventsController@index');
Route::delete('applied-events/{event}', 'AppliedEventsController@destroy');
Route::get('advertised-events', 'AdvertisedEventsController@index');
Route::patch('advertised-events/{event}/markCompleted', 'AdvertisedEventsController@markCompleted');


Auth::routes();
Route::get('/home', 'HomeController@show')->name('home');


