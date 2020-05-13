@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Events You Will Be Joining</h1>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Event Title</th>
                <th scope="col">View</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($events as $event)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $event->title }}</td>
                    <td><a href="/{{ $event->slugWithPrefix() }}">View</a></td>
                        <td><span class="badge badge-success">Joining</span></td>
                    <td>
                        <form method="POST" action="/applied-events/{{ $event->id }}">
                            @csrf {{ method_field("DELETE") }}
                            <button type="submit" class="btn btn-danger">
                               Cancel
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection


