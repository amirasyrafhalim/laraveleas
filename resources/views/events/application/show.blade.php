@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                {{ $applicant->name }} wants to join your event! 
            </div>
            {{-- @if($job->hired_user_id == null) --}}
                <div class="card-footer">
                    <form action="/events/{{ $event->id }}/applicant/{{ $applicant->id }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary float-right">Accept</button>
                    </form>
                </div>
            {{-- @endif --}}
        </div>

    </div>
@endsection