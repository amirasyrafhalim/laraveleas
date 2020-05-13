@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Events</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        Filter results
                    </div>
                    <div class="card-body">
                        <form class="input-group mb-5 flex-column" method="GET" action="/events">
                            <div>
                                <span>Search Anything...</span>
                                <input type="text" name="description" class="form-control" value="{{ Request::input('description') }}">
                            </div>
                            <div>
                                <span>By Title</span>
                                <input type="text" name="title" class="form-control" value="{{ Request::input('title') }}">
                            </div>
                                <div>
                                    <span>By Location</span>
                                    <select name="location" class="form-control" id="inlineFormCustomSelect">
                                    <option value="" selected>---Location---</option>
                                    @foreach ($locations as $code => $name)
                                        <option  {{ $locations == $code ? 'selected' : '' }} value="{{ $code }}">{{ $name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div>
                                    <span>By Category</span>
                                    <select name="category_id" class="form-control" id="inlineFormCustomSelect">
                                    <option value="" selected>---Category---</option>
                                    @foreach ($categories as $category)
                                        <option  {{ $categories == $category ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            <div class="mt-2">
                                <span>By Price</span>
                                <div class="flex-row">
                                    <input type="radio" name="price" id="price_asc" value="asc" {{ Request::input('price') == 'asc' ? 'checked' : '' }}>
                                    <label for="price_asc">Ascending</label>
                                </div>
                                <div class="flex-row">
                                    <input type="radio" name="price" id="price_desc" value="desc" {{ Request::input('price') == 'desc' ? 'checked' : '' }}>
                                    <label for="price_desc">Descending</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline-primary mt-2">Filter</button>
                        </form>
                    </div>
                    <form class="input-group mb-3 flex-column" method="GET" action="/events">
                        <button type="submit" class="btn btn-outline-primary mt-2">Reset</button>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    @forelse($events as $event)
                    @if($event->verified_by_admin == 1)
                        <div class="col-md-6 mb-3">
                            <div class="card" style="width: 18rem;">
                                <img src="{{ $event->default_image_path }}" class="card-img-top img-fluid" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><a href="/events/{{ $event->slug() }}">{{ $event->title }}</a></h5>
                                    <h6 class="card-title">{{ $event->created_at->diffForHumans() }} by <a href="/users/{{ $event->author->id }}">{{ $event->author->name }}</a></h6>
                                    <h6 class="card-title">Date of event : {{ $event->parsedEventDate }}</h6>
                                    <h6 class="card-title">Category: {{ $event->category->title }}</h6>
                                    @if($event->price == 0)
                                    <h6 class="card-title">Price: Free</h6>
                                    @else
                                    <h6 class="card-title">Price: {{ $event->price ? 'RM' . $event->price : '' }}
                                     @endif
                                    <h6 class="card-title">Location: {{ $event->location }}</h6>
                                    <h6 class="card-title">Description: {{ $event->description }}</h6>
                                    <h6 class="card-title">Official Website: {{ $event->website }}</h6>
                                    <a href="/events/{{ $event->slug() }}" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                        @endif
                    @empty
                        <p>No event found</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection