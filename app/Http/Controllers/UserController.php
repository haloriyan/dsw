<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\EventController as EventCtrl;
use App\Http\Controllers\EventTypeController as EventTypeCtrl;

class UserController extends Controller
{
    public $eventTypes = [];

    public function __construct() {
        $this->eventTypes = EventTypeCtrl::get()->with('events')->get();
    }
    public function index() {
        return view('pages.index', [
            'eventTypes' => $this->eventTypes
        ]);
    }
    public function contact() {
        return view('pages.contact-us.index', [
            'eventTypes' => $this->eventTypes
        ]);
    }
    public function event($id) {
        $event = EventCtrl::get([
            ['id', '=', $id]
        ])
        ->with('timeline')
        ->first();

        return view('pages.event', [
            'event' => $event,
            'eventTypes' => $this->eventTypes,
        ]);
    }
}
