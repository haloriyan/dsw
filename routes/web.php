<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function() {
	Route::get('login', 'AdminController@loginPage')->name('admin.loginPage');
	Route::post('login', 'AdminController@login')->name('admin.login.action');
	Route::get('logout', 'AdminController@logout')->name('admin.logout');
	Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');

	Route::get('faq', 'AdminController@faq')->name('admin.faq');
	Route::get('contact', 'AdminController@contact')->name('admin.contact');
	Route::get('sponsor', 'AdminController@sponsor')->name('admin.sponsor');
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
