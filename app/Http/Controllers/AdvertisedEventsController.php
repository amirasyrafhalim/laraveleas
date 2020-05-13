<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdvertisedEventsController extends Controller
{
    //**
   public function __construct()
   {
       $this->middleware('auth');
   }

   /**
    * Show all advertised jobs.
    *
    * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    */
   public function index()
   {
       $events = Auth::user()->events()->get();

       return view('advertised_event.index', compact('events'));
   }

   /**
    * Mark job as completed.
    *
    * @param Request $request
    * @param Job $job
    * @return \Illuminate\Http\RedirectResponse
    */
   public function markCompleted(Request $request, Event $event)
   {
       $event->update([
           'status' => Event::STATUS_COMPLETED,
       ]);

       return redirect()->back();
}
}




