<?php

namespace App\Http\Controllers;

use App\User;
use App\Event;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApproveApplicantController extends Controller
{
   /**
     * HiringApplicantController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Event $event, User $applicant, Request $request)
    {  
        $data = $request->except('_token');
        $user = Auth::user();
        $user->appliedEvents()==$user->approvalEvents();
        $event->userApprove_id = $applicant->id;
        $event->save();

        $event->approvedapplicants()->attach($event->id);
        return redirect('/' . $event->slugWithPrefix() . '/applications')->with('message', $applicant->name . ' is joining the event!');
    }

    /**
     * Get the user application.
     *
     * @param Job $job
     * @param User $applicant
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Event $event, User $applicant)
    {

        return view('events.application.show', compact('event', 'applicant'));
    }



}
