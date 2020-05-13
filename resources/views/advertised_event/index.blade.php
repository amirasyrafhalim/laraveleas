@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your advertised events</h1>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Event Title</th>
                <th scope="col">View Applicants</th>
                <th scope="col">Status</th>
                <th scope="col">Approval</th>
            </tr>
            </thead>
            <tbody>
            @foreach($events as $event)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td><a href="/{{ $event->slugWithPrefix() }}">{{ $event->title }}</a></td>
                    @if ($event->isRequired())
                    <td><a href="/{{ $event->slugWithPrefix() }}/applications">Applicants</a></td>
                    @elseif($event->isOpen())
                    <td>This is an open event</td>
                    @endif
                    <td><span class="badge badge-success">{{ \App\Event::STATUS_TYPE[$event->status] }}</span></td>
                    @if ($event->verified_by_admin == 1)
                    <td><span class="badge badge-success">Approved</span></td>
                    @elseif(!$event->verified_by_admin == 1)
                    <td><span class="badge badge-danger">Waiting</span></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection