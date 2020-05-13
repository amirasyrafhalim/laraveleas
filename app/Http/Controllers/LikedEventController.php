<?php

namespace App\Http\Controllers;
use App\User;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikedEventController extends Controller
{
        /**
     * constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all liked event.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $events = Auth::user()->likedEvents()->get();

        return view('liked_event.index', compact('events'));
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
        $user->likedEvents()->attach($event->id);

        return $this->makeResponse('Event successfully applied', $event->slugWithPrefix(), 200);
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
        $user->likedEvents()->detach($event->id);
        return redirect()->back();
    }
}
