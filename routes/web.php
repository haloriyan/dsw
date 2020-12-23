<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('pwd', function () {
    return bcrypt("inikatasandi");
});

Route::group(['prefix' => 'admin'], function() {
	Route::get('login', 'AdminController@loginPage')->name('admin.loginPage');
	Route::post('login', 'AdminController@login')->name('admin.login');
	Route::get('logout', 'AdminController@logout')->name('admin.logout');
	Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard')->middleware('Admin');

	Route::get('profile', 'AdminController@profile')->name('admin.profile')->middleware('Admin');
	Route::post('profile/update', 'AdminController@updateProfile')->name('admin.profile.update')->middleware('Admin');
	Route::get('faq', 'AdminController@faq')->name('admin.faq')->middleware('Admin');
    Route::get('contact', 'AdminController@contact')->name('admin.contact')->middleware('Admin');
    Route::get('sponsor-type', 'AdminController@sponsorType')->name('admin.sponsorType')->middleware('Admin');
	Route::get('sponsor', 'AdminController@sponsor')->name('admin.sponsor')->middleware('Admin');
	Route::get('event-type', 'AdminController@eventType')->name('admin.eventType')->middleware('Admin');
	Route::get('event', 'AdminController@event')->name('admin.event')->middleware('Admin');
	Route::get('speaker', 'AdminController@speaker')->name('admin.speaker')->middleware('Admin');
	Route::get('judge', 'AdminController@judge')->name('admin.judge')->middleware('Admin');
});

Route::group(['prefix' => 'faq'], function() {
    Route::get('create', 'FaqController@create')->name('faq.create');
    Route::get('{id}/view', 'FaqController@view')->name('faq.view');
    Route::get('{id}/edit', 'FaqController@edit')->name('faq.edit');

	Route::post('store', 'FaqController@store')->name('faq.store');
	Route::post('update', 'FaqController@update')->name('faq.update');
	Route::delete('{id}/delete', 'FaqController@delete')->name('faq.delete');
});

Route::group(['prefix' => 'contact'], function() {
    Route::get('create', 'ContactController@create')->name('contact.create');
    Route::get('{id}/view', 'ContactController@view')->name('contact.view');
    Route::get('{id}/edit', 'ContactController@edit')->name('contact.edit');

	Route::post('store', 'ContactController@store')->name('contact.store');
	Route::post('update', 'ContactController@update')->name('contact.update');
	Route::delete('{id}/delete', 'ContactController@delete')->name('contact.delete');
});

Route::group(['prefix' => 'sponsorType'], function() {
    Route::get('create', 'SponsorTypeController@create')->name('sponsorType.create');
    Route::get('{id}/edit', 'SponsorTypeController@edit')->name('sponsorType.edit');

	Route::post('store', 'SponsorTypeController@store')->name('sponsorType.store');
	Route::post('update', 'SponsorTypeController@update')->name('sponsorType.update');
	Route::delete('{id}/delete', 'SponsorTypeController@delete')->name('sponsorType.delete');
});

Route::group(['prefix' => 'sponsor'], function() {
    Route::get('create', 'SponsorController@create')->name('sponsor.create');
    Route::get('{id}/view', 'SponsorController@view')->name('sponsor.view');
    Route::get('{id}/edit', 'SponsorController@edit')->name('sponsor.edit');


	Route::post('store', 'SponsorController@store')->name('sponsor.store');
	Route::post('update', 'SponsorController@update')->name('sponsor.update');
	Route::delete('{id}/delete', 'SponsorController@delete')->name('sponsor.delete');
});

Route::group(['prefix' => 'eventType'], function() {
    Route::get('create', 'EventTypeController@create')->name('eventType.create');
    Route::get('{id}/edit', 'EventTypeController@edit')->name('eventType.edit');

	Route::post('store', 'EventTypeController@store')->name('eventType.store');
	Route::post('update', 'EventTypeController@update')->name('eventType.update');
	Route::delete('{id}/delete', 'EventTypeController@delete')->name('eventType.delete');
});

Route::group(['prefix' => 'event'], function() {
    Route::get('create', 'EventController@create')->name('event.create');
    Route::get('{id}/view', 'EventController@view')->name('event.view');
    Route::get('{id}/edit', 'EventController@edit')->name('event.edit');

	Route::post('store', 'EventController@store')->name('event.store');
	Route::post('{id}/update', 'EventController@update')->name('event.update');
	Route::delete('{id}/delete', 'EventController@delete')->name('event.delete');
});

Route::group(['prefix' => 'speaker'], function() {
	Route::post('store', 'SpeakerController@store')->name('speaker.store');
	Route::post('update', 'SpeakerController@update')->name('speaker.update');
	Route::delete('delete', 'SpeakerController@delete')->name('speaker.delete');
});

Route::group(['prefix' => 'judge'], function() {
	Route::post('store', 'JudgeController@store')->name('judge.store');
	Route::post('update', 'JudgeController@update')->name('judge.update');
	Route::delete('delete', 'JudgeController@delete')->name('judge.delete');
});
