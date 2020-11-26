<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function() {
	Route::get('login', 'AdminController@loginPage')->name('admin.loginPage');
	Route::post('login', 'AdminController@login')->name('admin.login');
	Route::get('logout', 'AdminController@logout')->name('admin.logout');
	Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');

	Route::get('faq', 'AdminController@faq')->name('admin.faq');
	Route::get('contact', 'AdminController@contact')->name('admin.contact');
	Route::get('sponsor', 'AdminController@sponsor')->name('admin.sponsor');
	Route::get('event-type', 'AdminController@eventType')->name('admin.eventType');
	Route::get('event', 'AdminController@event')->name('admin.event');
	Route::get('speaker', 'AdminController@speaker')->name('admin.speaker');
	Route::get('judge', 'AdminController@judge')->name('admin.judge');
});

Route::group(['prefix' => 'faq'], function() {
	Route::post('store', 'FaqController@store')->name('faq.store');
	Route::post('update', 'FaqController@update')->name('faq.update');
	Route::delete('delete', 'FaqController@delete')->name('faq.delete');
});

Route::group(['prefix' => 'contact'], function() {
	Route::post('store', 'ContactController@store')->name('contact.store');
	Route::post('update', 'ContactController@update')->name('contact.update');
	Route::delete('delete', 'ContactController@delete')->name('contact.delete');
});

Route::group(['prefix' => 'sponsor'], function() {
	Route::post('store', 'SponsorController@store')->name('sponsor.store');
	Route::post('update', 'SponsorController@update')->name('sponsor.update');
	Route::delete('delete', 'SponsorController@delete')->name('sponsor.delete');
});

Route::group(['prefix' => 'eventType'], function() {
	Route::post('store', 'EventTypeController@store')->name('eventType.store');
	Route::post('update', 'EventTypeController@update')->name('eventType.update');
	Route::delete('delete', 'EventTypeController@delete')->name('eventType.delete');
});

Route::group(['prefix' => 'event'], function() {
	Route::post('store', 'EventController@store')->name('event.store');
	Route::post('update', 'EventController@update')->name('event.update');
	Route::delete('delete', 'EventController@delete')->name('event.delete');
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
