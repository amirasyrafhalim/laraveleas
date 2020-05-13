@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Events You Have Liked</h1>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Event Title</th>
                <th scope="col">View</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($events as $event)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $event->title }}</td>
                    <td><a href="/{{ $event->slugWithPrefix() }}">View</a></td>
                    <td>
                        <form method="POST" action="/liked-events/{{ $event->id }}">
                            @csrf {{ method_field("DELETE") }}
                            <button type="submit" class="btn btn-danger">
                               Unlike
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
