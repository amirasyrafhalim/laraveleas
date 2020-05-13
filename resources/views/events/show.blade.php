@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>{{ $event->title }}</h1>
                <p>By <a href="/users/{{ $event->author->id }}">{{ $event->author->name }}</a><small>{!! $event->isOwner() ? "- <a href=\"/events/" . $event->id . "/edit/\">Edit Event</a>" : '' !!}</small>
                    @if($event->isOwner())
                        <span class="badge badge-pill badge-info">{{ \App\event::STATUS_TYPE[$event->status] }}</span>
                    @endif
                </p>
                <h4>
                    Category: {{ $event->category->title }}
                </h4>
                @if($event->price == 0)
                <h4>
                   Price: Free
                </h4>
                @else
                <h4>
                    Price: {{ $event->price ? 'RM' . $event->price : '' }}
                </h4>
                 @endif
                <h4>
                    Date of event: {{ $event->parsedEventDate }}
                </h4>
                    <h4>Official Website:<a href="https://{{ ($event->website) }}"> {{ $event->website }} </a></h4>
                <div class="row">
                    <img class="img-fluid" src="{{$siteurl . $event->getDefaultImage()}}" alt="">
                </div>
               
                <h2>All images</h2>
                <div class="row">
                    @foreach($imageArr as $image)
                        <div class="col-md-6">
                            <img src="{{$siteurl .  $image->path }}" class="img-fluid" alt="">
                        </div>
                    @endforeach
                </div>
            </div>

           @if(Auth::check() && !Auth::user()->user_type == 1)
            <div class="col-md-4">
                <h3>Join event</h3>
                @if($event->isPublished())
                    @if (!$event->isOwner())
                        @if(!Auth::user()->hasAppliedEvent($event) && $event->isRequired())
                            <a href="/{{ $event->slugWithPrefix() }}/apply" class="btn btn-outline-success">Join</a>    
                        @elseif(Auth::user()->hasAppliedEvent($event))
                            You are joining the event
                        @elseif (!$event->isRequired())
                            <h5>This is an open event. Anyone who is interested to go for the event can either message or contact the author of the event</h5>
                        @endif   
                     @elseif  ($event->isOwner())
                        You are the owner of the event      
                    @endif
                @elseif ($event->isClosed())
                    @if (!$event->isOwner())
                    Event will not accepting participants anymore
                    @elseif($event->isOwner())
                    You are the owner of the event
                    @endif
                @else
                    Event has been cancelled
                @endif
            @endif
            @if(Auth::check() && !Auth::user()->user_type == 1)
            <div>
                <p></p>
                <h3>Favourite Event</h3>
                @if($event->isPublished())
                    @if (!$event->isOwner())
                        @if(!Auth::user()->hasLikedEvent($event))
                        <form method="POST" action="/{{ $event->slugWithPrefix() }}/like">
                            @csrf
                                    <button type="submit" class="btn btn-outline-primary">
                                       Like
                                    </button>

                        </form>   
                        @else
                            You have liked the event
                        @endif   
                     @elseif  ($event->isOwner())
                        You are the owner of the event      
                    @endif
                @elseif ($event->isClosed())
                    @if (!$event->isOwner())
                    <h3></h3>
                    @elseif($event->isOwner())
                    You are the owner of the event
                    @endif
                @else
                    Event has been cancelled
                @endif
            @endif
            <div class="col-md-4">
            @if(Auth::guest() && $event->isRequired())
            <h3>Join event</h3>
            Please <a href="/login">sign in</a> or <a href="/register">register</a> to join the event.
            @elseif($event->isOpen() && Auth::guest() )
            <h3>This is an open event. Please <a href="/login">sign in</a> or <a href="/register">register</a> for more. </h3>
            @endif
            </div>
            </div>
            
          
           
        </div>
    </div>
@endsection