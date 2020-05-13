@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-3 text-center">Welcome to Event Advertisement System</h1>
            <p class="text-center">Event Advertisement System provides a center for your events to be advertised</p>
        </div>

        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Latest Events...</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse($events as $event)
                    @if ($event->verified_by_admin == 1)
                        <div class="col-md-4 mt-3">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ $event->default_image_path }}" class="card-img-top img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="/events/{{ $event->slug() }}">{{ $event->title }}</a></h5>
                                    <h6 class="card-title">{{ $event->created_at->diffForHumans() }} by <a href="/users/{{ $event->author->id }}">{{ $event->author->name }}</a></h6>
                                    <h6 class="card-title">Date of event : {{ $event->parsedEventDate }}</h6>
                                    @if($event->price == 0)
                                    <h6 class="card-title">Price: Free</h6>
                                    @else
                                    <h6 class="card-title">Price: {{ $event->price ? 'RM' . $event->price : '' }}
                                     @endif
                                     <h6 class="card-title"><h6>Official Website:<a href="https://{{ ($event->website) }}"> {{ $event->website }} </a></h6></h6>
                                    <a href="/events/{{ $event->slug() }}" class="btn btn-outline-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                     @endif
                    @empty
                        <p>No events found</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection



