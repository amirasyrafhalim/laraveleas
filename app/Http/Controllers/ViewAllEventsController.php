<?php

namespace App\Http\Controllers;
    
use App\Event;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewAllEventsController extends Controller
{

        //**
       public function __construct()
       {
           $this->middleware('admin');
       }
    
       /**
        * Show all advertised events.
        *
        * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
        */
       public function index(Request $request)
       {
           $this->authorize('viewAny', Event::class);  
           $events = Event::published();
    
           return view('viewallevents.index', compact('events'));
       }

       /**
     * @param Document $document
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Event $event)
    {
        $event->verified_by_admin = Auth::user()->id;
        $event->save();
        return redirect()->back();
    }

         /**
     * Delete event
     */
    public function destroy(Event $event)
    {

        $event->delete();

        return redirect()->back();
    }

}
