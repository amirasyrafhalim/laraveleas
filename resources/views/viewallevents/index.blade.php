@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>All advertised events</h1>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Event Title</th>
                <th scope="col">Author</th>
                <th scope="col">View Event</th>
                <th scope="col">Action</th>
                <th scope="col">Request</th>
            </tr>
            </thead>
            <tbody>
            @foreach($events as $event)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $event->title }}</td>
                    <td><a href="/users/{{ $event->author->id }}">{{ $event->author->name }}</a></td>
                    <td><a href="/{{ $event->slugWithPrefix() }}" class="btn btn-primary">View</a></td>   
                    <td>
                        <form method="POST" action="/viewallevents/{{ $event->id }}">
                            @csrf {{ method_field("DELETE") }}
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                    @if (!$event->verified_by_admin == 1)
                    <td>
                        <form method="POST" action="/viewallevents/{{ $event->id }}">
                            @csrf {{ method_field("PATCH") }}
                            <button type="submit" class="btn btn-outline-success">
                                Approve
                            </button>
                        </form>
                    </td>
                    @else
                    <td><span class="badge badge-success">Approved</span></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection