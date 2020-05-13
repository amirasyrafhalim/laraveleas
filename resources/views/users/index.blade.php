@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>More categories..</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        Filter results
                    </div>
                    <div class="card-body">
                        <form class="input-group mb-3" method="GET" action="/Categories">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-default">Search</span>
                            </div>
                            <input type="text" name="title" class="form-control" value="{{ Request::input('title') }}">
                        </form>
                    </div>
                    <form class="input-group mb-3 flex-column" method="GET" action="/Categories">
                        <button type="submit" class="btn btn-outline-primary mt-2">Reset</button>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    @forelse($skills as $skill)
                        <div class="col-md-6 mb-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $skill->title }}</h5>
                                    <ul>
                                        @foreach($skill->users as $user)
                                            <a href="/users/{{ $user->id }}">{{ $user->name }}</a>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>No user found</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection