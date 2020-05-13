<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class EventApplicationController extends Controller
{
    /**
     * JobApplicationController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all applicants joining the event.
     *
     * @param Job $job
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Event $event, $slug)
    {
        if($slug != Str::slug($event->title)) {
            abort(404);
        }

        $event->load('applicants');

        return view('events.application.index', compact('event'));
    }

    /**
     * Show event form.
     *
     * @param Job $job
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Event $event, $slug)
    {
       
        return view('events.application.create', compact('event'));
    }

    /**
     * Store event to database
     *
     * @param event
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Event $event, Request $request)
    {
        if($event->status != Event::STATUS_PUBLISHED) {
            abort(400);
        }

        $data = $request->except('_token');

        $user = Auth::user();
        $user->appliedEvents()->attach($event->id);

        return $this->makeResponse('Event successfully applied', $event->slugWithPrefix(), 200);
    }

     /**
     * Remove User
     *
     * @param event
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Event $event , User $user)
    {
     
        $data = $request->except('_token');

        $user = Auth::user();
        $user->appliedEvents()->detach($event->id);
        return redirect()->back();
    }
}