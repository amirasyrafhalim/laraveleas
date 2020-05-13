<?php

namespace App\Http\Controllers;
use App\User;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppliedEventsController extends Controller
{

    /**
     * constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all applied event.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $events = Auth::user()->appliedEvents()->get();

        return view('applied_event.index', compact('events'));
    }
    /**
     * Remove event
     *
     * @param Skill $skill
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Event $event , User $user, Request $request)
    {
        $data = $request->except('_token');

        $user = Auth::user();
        $user->appliedEvents()->detach($event->id);
        return redirect()->back();
    }
}


