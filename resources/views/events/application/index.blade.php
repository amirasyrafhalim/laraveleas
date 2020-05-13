@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Who are going to join <a href="/{{ $event->slugWithPrefix() }}">{{ $event->title }} </a>event!</h1>

        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($event->applicants as $applicant)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td><a href="/users/{{ $applicant->id }}">{{ $applicant->name}}</a> </td>
                    <td><span class="badge badge-success">Joining</span></td>  
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
