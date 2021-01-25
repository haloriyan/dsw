<?php

use Illuminate\Support\Facades\Route;

Route::get('/', "UserController@index")->name('user.index');
Route::get('rundown', "UserController@rundown")->name('user.rundown');
Route::get('contact', "UserController@contact")->name('user.contact');
Route::get('ticket', "UserController@ticket")->name('user.ticket');
Route::get('my-ticket', "UserController@myTicket")->name('user.myTicket');
Route::get('invoice', "UserController@invoice")->name('user.invoice');
Route::get('my-team', "UserController@myTeam")->name('user.myTeam');
Route::get('active', "UserController@active")->name('user.active');
Route::get('admin', function() {
	return redirect()->route('admin.loginPage');
})->name('admin');

Route::get('test', "UserController@testMail");

Route::group(['prefix' => "team"], function() {
	Route::get('create', "TeamController@create")->name('user.team.create');
	Route::post('store', "TeamController@store")->name('user.team.store');
});

Route::group(['prefix' => "user"], function() {
	Route::get('login', 'UserController@loginPage')->name('user.loginPage');
	Route::get('register', 'UserController@registerPage')->name('user.registerPage');
	Route::post('login', 'UserController@login')->name('user.login');
	Route::post('register', 'UserController@register')->name('user.register');
	Route::get('logout', 'UserController@logout')->name('user.logout');

	Route::get('profile', 'UserController@profile')->name('user.profile');
	Route::post('profile/update', 'UserController@updateProfile')->name('user.updateProfile');
});

Route::group(['prefix' => "role"], function() {
	Route::get('create', "RoleController@create")->name('role.create');
	Route::post('store', "RoleController@store")->name('role.store');
	Route::get('{id}/edit', "RoleController@edit")->name('role.edit');
	Route::post('{id}/update', "RoleController@update")->name('role.update');
	Route::delete('{id}/delete', "RoleController@delete")->name('role.delete');
});

Route::group(['prefix' => 'admin'], function() {
	Route::get('login', 'AdminController@loginPage')->name('admin.loginPage');
	Route::post('login', 'AdminController@login')->name('admin.login');
	Route::get('logout', 'AdminController@logout')->name('admin.logout');
	Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard')->middleware('Admin');

	Route::get('profile', 'AdminController@profile')->name('admin.profile')->middleware('Admin');
	Route::post('profile/update', 'AdminController@updateProfile')->name('admin.profile.update')->middleware('Admin');
	
	Route::get('admin', 'AdminController@admin')->name('admin.admin')->middleware('Admin');
	Route::get('create', 'AdminController@create')->name('admin.create')->middleware('Admin');
	Route::post('store', 'AdminController@store')->name('admin.store')->middleware('Admin');
	Route::get('{id}/edit', 'AdminController@edit')->name('admin.edit')->middleware('Admin');
	Route::post('{id}/update', 'AdminController@update')->name('admin.update')->middleware('Admin');
	Route::delete('{id}/delete', 'AdminController@delete')->name('admin.delete')->middleware('Admin');
	
	Route::get('faq', 'AdminController@faq')->name('admin.faq')->middleware('Admin');
    Route::get('contact', 'AdminController@contact')->name('admin.contact')->middleware('Admin');
    Route::get('sponsor-type', 'AdminController@sponsorType')->name('admin.sponsorType')->middleware('Admin');
	Route::get('sponsor', 'AdminController@sponsor')->name('admin.sponsor')->middleware('Admin');
	Route::get('event-type', 'AdminController@eventType')->name('admin.eventType')->middleware('Admin');
	Route::get('event/{rundownID?}', 'AdminController@event')->name('admin.event')->middleware('Admin');
	Route::get('speaker', 'AdminController@speaker')->name('admin.speaker')->middleware('Admin');
	Route::get('judge', 'AdminController@judge')->name('admin.judge')->middleware('Admin');
	Route::get('judge/create', 'JudgeController@create')->name('judge.create')->middleware('Admin');
	Route::get('judge/{id}/edit', 'JudgeController@edit')->name('judge.edit')->middleware('Admin');
	Route::get('timeline/{eventID?}', 'AdminController@timeline')->name('admin.timeline')->middleware('Admin');
	Route::get('rundown', 'AdminController@rundown')->name('admin.rundown')->middleware('Admin');
	Route::get('ticket-type', 'AdminController@ticketType')->name('admin.ticketType')->middleware('Admin');
	Route::get('ticket/{typeID?}', 'AdminController@ticket')->name('admin.ticket')->middleware('Admin');
	Route::get('ticket/{typeID}/participant', 'TicketController@participant')->name('admin.ticket.participant')->middleware('Admin');
	Route::get('role', 'AdminController@role')->name('admin.role')->middleware('Admin');
	
	Route::get('team', 'AdminController@team')->name('admin.team')->middleware('Admin');
	Route::get('team/{id}/detail', 'TeamController@detail')->name('admin.team.detail')->middleware('Admin');
	
	Route::get('user', 'AdminController@user')->name('admin.user')->middleware('Admin');
});

Route::group(['prefix' => 'ticket'], function() {
	Route::get('create', 'TicketController@create')->name('ticket.create')->middleware('Admin');
	Route::post('store', 'TicketController@store')->name('ticket.store')->middleware('Admin');
	Route::get('{id}/edit', 'TicketController@edit')->name('ticket.edit')->middleware('Admin');
	Route::post('{id}/update', 'TicketController@update')->name('ticket.update')->middleware('Admin');
	Route::delete('{id}/delete', 'TicketController@delete')->name('ticket.delete')->middleware('Admin');

	Route::get('{id}/buy', 'UserController@buyTicket')->name('ticket.buy')->middleware('User');
	Route::post('buy', 'TicketOrderController@buy')->name('ticket.buy.order');
	Route::get('checkout', 'UserController@checkoutTicket')->name('ticket.checkout')->middleware('User');
	Route::post('complete', 'TicketOrderController@completeOrder')->name('ticket.completeOrder');
});

Route::group(['prefix' => 'ticket-type'], function() {
	Route::get('create', 'TicketTypeController@create')->name('ticketType.create')->middleware('Admin');
	Route::post('store', 'TicketTypeController@store')->name('ticketType.store')->middleware('Admin');
	Route::get('{id}/edit', 'TicketTypeController@edit')->name('ticketType.edit')->middleware('Admin');
	Route::post('{id}/update', 'TicketTypeController@update')->name('ticketType.update')->middleware('Admin');
	Route::delete('{id}/delete', 'TicketTypeController@delete')->name('ticketType.delete')->middleware('Admin');
});

Route::group(['prefix' => 'timeline'], function() {
	Route::get('create', 'TimelineController@create')->name('timeline.create')->middleware('Admin');
	Route::post('store', 'TimelineController@store')->name('timeline.store')->middleware('Admin');
	Route::get('{id}/edit', 'TimelineController@edit')->name('timeline.edit')->middleware('Admin');
	Route::post('{id}/update', 'TimelineController@update')->name('timeline.update')->middleware('Admin');
	Route::delete('{id}/delete', 'TimelineController@delete')->name('timeline.delete')->middleware('Admin');
});

Route::group(['prefix' => 'rundown'], function() {
	Route::get('create', 'RundownController@create')->name('rundown.create');
	Route::post('store', 'RundownController@store')->name('rundown.store');
	Route::get('{id}/view', 'RundownController@view')->name('rundown.view');
	Route::get('{id}/edit', 'RundownController@edit')->name('rundown.edit');
	Route::post('{id}/update', 'RundownController@update')->name('rundown.update');
	Route::delete('{id}/delete', 'RundownController@delete')->name('rundown.delete');
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
	Route::get('{id}', "UserController@event")->name('user.event');
});

Route::group(['prefix' => 'speaker'], function() {
    Route::get('create', 'SpeakerController@create')->name('speaker.create');
    Route::get('{id}/view', 'SpeakerController@view')->name('speaker.view');
    Route::get('{id}/edit', 'SpeakerController@edit')->name('speaker.edit');

	Route::post('store', 'SpeakerController@store')->name('speaker.store');
	Route::post('update', 'SpeakerController@update')->name('speaker.update');
	Route::delete('delete', 'SpeakerController@delete')->name('speaker.delete');
});

Route::group(['prefix' => 'judge'], function() {
	Route::post('store', 'JudgeController@store')->name('judge.store');
	Route::post('{id}/update', 'JudgeController@update')->name('judge.update');
	Route::delete('{id}/delete', 'JudgeController@delete')->name('judge.delete');
});
