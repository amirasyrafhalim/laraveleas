<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;

class MessagesController extends Controller
{

    /**
     * MessagesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show all user's messages.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $shownUser = [];

        $messages = Message::where(function ($query) {
            $query->where([
                'sender_id' => auth()->user()->id
            ]);
            $query->orWhere([
                'recipient_id' => auth()->user()->id
            ]);
        })->get();

        $messages->each(function($message) use (&$shownUser) {
            if ($message->sender_id != auth()->user()->id) {
                array_push($shownUser, $message->sender_id);
            }
            if ($message->recipient_id != auth()->user()->id) {
                array_push($shownUser, $message->recipient_id);
            }
        });

        $chattedUsers = User::find($shownUser);
        return view('messages.index', compact('messages', 'chattedUsers'));
    }

    /**
     * Show message with a specific user.
     *
     * @param User $receiver
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $receiver)
    {
        $messages = Message::where(function ($query) use ($receiver) {
            $query->where([
               'sender_id' => auth()->user()->id,
               'recipient_id' => $receiver->id,
            ]);
        })->orWhere(function ($query) use ($receiver) {
            $query->where([
                'sender_id' => $receiver->id,
                'recipient_id' => auth()->user()->id,
            ]);
        })->with(['sender', 'recipient'])->get();

        return view('messages.show', compact('messages', 'receiver'));
    }

    /**
     * Store the message.
     *
     * @param User $receiver
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(User $receiver, Request $request)
    {
        $message = new Message();
        $message->sender_id = auth()->user()->id;
        $message->recipient_id = $receiver->id;
        $message->body = $request->body;
        $message->save();

        return redirect()->back();
    }
}