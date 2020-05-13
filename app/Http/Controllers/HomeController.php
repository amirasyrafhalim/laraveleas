<?php
namespace App\Http\Controllers;

use App\Event;
use App\User;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
 
    /**
     * Show the application homepage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        $events = Event::with('author')->get() ;
     
        
        $events = Event::with('author')->take(20)->get();

        $events->each(function($event) {
            if($event->images->count() > 0) {
                $siteurl = 'http://localhost:8000/uploads/';
                $event->default_image_path = $siteurl . $event->images->first()->path;
            } else {
                $event->default_image_path = 'https://placehold.co/300x300';
            }
        });

        return view('home', compact('events'));
    }
}