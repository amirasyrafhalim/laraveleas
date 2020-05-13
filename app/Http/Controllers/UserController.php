<?php

namespace App\Http\Controllers;

use App\User;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show(User $user)
    { 
        
        return view('userprofile.show' , compact ('user'));
    }
}


