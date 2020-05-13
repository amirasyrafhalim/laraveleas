@extends('layouts.app')

@section ('content')
    <div class="container">
        <h1>Profile</h1>
        <div class="media border p-3">
            <img src="{{ $user->getAvatar() }}" alt="{{ $user->name }}" class="img-thumbnail">
          
            <div class="media-body">
                <h4>{{ $user->name }}</h4>
                <ul>
                    <li>
                        From {{ $user->address }}
                    </li>
                    <li>
                        Phone Number {{ $user->phoneNum }}
                    </li>
                </ul>
                <div class="col text-right">
                    <a href="/userprofile/edit" class="btn btn-info" role="button">Edit Profile</a>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-8">
                @if(!is_null($user->description))
                    <h4>Description</h4>
                    <p>{{ $user->description }}</p>
                @endif
                @if(!is_null($user->address))
                    <h4>Language</h4>
                    <p>{{ $user->address }}</p>
                @endif
            </div>
        </div>
    </div>
@endsection
