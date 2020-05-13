<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class profile extends Controller
{

    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show user profile.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        $user = Auth::user();

        return view('userprofile.show', compact('user'));
    }

    /**
     * Show edit profile form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
      
        $user = Auth::user();
        // dd($user);
        return view('userprofile.edit', compact('user'));
    }

    /**
     * Update the profile.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'max:255',
            'avatar' => 'file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phoneNum' => 'max:255',
            'address' => 'max:255'
        ]);

        $user = Auth::user();

        $user->update([
            'name' => $request->name,
            'phoneNum' => $request->phoneNum,
            'address' => $request->address,
       
        ]);

        if($request->avatar) {
            $image = $request->file('avatar');
            $extension = $image->getClientOriginalExtension();
            Storage::disk('public')->put('avatar/'. Auth::user()->id . $image->getFilename().'.'.$extension,  File::get($image));
            $path = 'avatar/' . Auth::user()->id . $image->getFilename().'.'.$extension;
            $user->avatar_path = $path;
        }

       
        $user->save();

    
        return redirect('userprofile')->with('status', 'Profile updated!');
       
    }
}



