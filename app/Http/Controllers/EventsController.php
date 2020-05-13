<?php
namespace App\Http\Controllers;

use App\User;
use App\Image;
use App\Event;
use App\Category;
use App\Locations;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class EventsController extends Controller
{
    /**
     * EventssController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'index');
    }

    /**
     * Show all events
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Event::class);
        $categories = Category::all();
        $locations=Locations::LOCATIONS;

        if($request->title != null || $request->price != null || $request->eventdate != null || $request->description != null || $request->location!= null || $request->category_id!= null) 
        {
                $events = Event::byTitleContains($request->title);  
            
           
            if($request->description != null) 
            {
                $events = Event::byDescriptionContains($request->description);

            }

            if($request->eventdate != null) 
            {
                $time = Carbon::parse($request->eventdate)->format('Y-m-d H:i:s');

                $events->where('eventdate', '<=', $time);
            }

            if($request->price != null) 
            {
                if($request->price == 'asc')
                {
                    $events->orderBy('price', 'asc');
                } 
                elseif($request->price == 'desc') 
                {
                    $events->orderBy('price', 'desc');
                }

            }
            if($request->location != null )
            {
               
                $events->where('location', $request->location);
               
            }
            if($request->category_id != null )
            {
               
                $events->where('category_id', $request->category_id);
               
            }

            $events = $events->get();
        } 
        else 
        {
            $events = Event::published();
        }


        
        $events->each(function($event) 
        {
            if($event->images->count() > 0) 
            {
                $siteurl = 'http://localhost:8000/uploads/';
                $event->default_image_path = $siteurl . $event->images->first()->path;
            } 
            else 
            {
                $event->default_image_path = 'https://placehold.co/300x300';
            }
        });

        return view('events.index', compact('events','categories', 'locations'));
    }

    /**
      * show create event page
      */
    public function create()
    {
        $this->authorize('create', Event::class);
        $categories = Category::all();
        $locations=Locations::LOCATIONS;
        $user= Auth::user();
     

        
        return view ('events.create' , compact ('user','categories','locations'));
    }
     /**
      * store event to database
      */
    public function store(Request $request)
    {
        $this->authorize('create', Event::class);
        $request->validate([
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:5',
            'location' => 'required',
            'price' => 'required|numeric|min:0|max:99999',
            'eventdate' => 'date',
            'status' =>'required|in:' . implode(',', Event::STATUSES),
            'category_id' => 'required',
            'eventtype' =>'required|in:' . implode(',', Event::TYPES),
            'website' => 'required|min:1|max:255', 
            
        ]);

        $event = auth()->user()->events()->create([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'price' => $request->price * 1,
            'eventdate' => Carbon::parse($request->eventdate)->format('Y-m-d H:i:s'),
            'status' => $request->status,
            'category_id' => $request->category_id,
            'eventtype' => $request->eventtype,
            'website' => $request->website,
            
            
        ]);
        
        $images = $request->file('images');

        if($images != null) 
        {
            foreach ($images as $image) {
                $extension = $image->getClientOriginalExtension();
                Storage::disk('public')->put($image->getFilename().'.'.$extension,  File::get($image));
                $path = $image->getFilename().'.'.$extension;
                $event->images()->create(['path' => $path]);
            }

            $defaultImage = $event->images()->first();
            $defaultImage->is_default = Image::DEFAULT_IMAGE;
            $defaultImage->save();
    
            return $this->makeResponse("Event $event->title successfully created", "/events/" . $event->slug(), 200);
        }
        
    
    }

        /**
     * Show single event page.
     *
     */
    public function show(Event $event, $slug)
    {
        $this->authorize('create', $event);
        $event = Event::with('category')->where('id', $event->id)->first();
        // dd($event);


        $event->load('images');

        $imageArr = $event->images;
        // dd($imageArr);

        $siteurl = 'http://localhost:8000/uploads/';

        if($slug != Str::slug($event->title))
        {
            abort(404);
        }

        return view('events.show', compact('event', "imageArr", 'siteurl'));
    }



        public function edit(Event $event)
    {
        $this->authorize('update' , $event);
         $categories = Category::all();
        $locations=Locations::LOCATIONS;
        return view('events.edit', compact('event','categories','locations'));
    }


         /**
     * Update the job.
     *
     * @param Job $job
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Event $event, Request $request)
    {
        $this->authorize('update', $event);
        
        $request->validate([
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:5',
            'location' => 'required',
            'price' => 'required|numeric|min:0|max:99999',
            'eventate' => 'date',
            'status' =>'required|in:' . implode(',', Event::STATUSES),
            'category_id' => 'required',
            'eventtype' =>'required|in:' . implode(',', Event::TYPES),
            'website' => 'required|min:1|max:255', 
        ]);

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'price' => $request->price * 1,
            'eventdate' => Carbon::parse($request->eventdate)->format('Y-m-d H:i:s'),
            'status' => $request->status,
            'category_id' => $request->category_id,
            'eventtype' => $request->eventtype,
            'website' => $request->website,
            
        ]);
    
        return $this->makeResponse("Event $event->title successfully updated", "/events/" . $event->slug(), 200);
    }
    /**
     * Delete event
     */
    public function destroy(Event $event)
    {

        $event->delete();

        return $this->makeResponse("Event $event->title successfully deleted", "/events/", 200);
    }


}
