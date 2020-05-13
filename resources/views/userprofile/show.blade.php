@extends('layouts.app')

@section ('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ $user->name }}</h1>
            </div>
            <div class="col-md-12 media border px-3 py-3 d-flex">
                <div class="col-md-3">
                    <img src="{{ $user->getAvatar() }}"  alt="{{ $user->name }}" class="img-fluid img-thumbnail">
                    @if(Auth::user())
                        @if(Auth::user()->id == $user->id)
                            <a href="/userprofile/edit" class="btn btn-outline-primary mt-3">Edit Profile</a>
                        @else
                            <a href="/messages/{{ $user->id }}" class="btn btn-outline-success mt-3">Message</a>
                        @endif
                    @endif
                </div>
                <div class="col-md-9">
                    <h4>Name : </h4>
                    <p> {{ $user->name }}</p>
                    @if($user->phoneNum)
                    <h4>Phone Number :</h4>
                        <p>{{ $user->phoneNum }}</p>
                    @else
                    <h4>Phone Number :</h4>
                        Phone number is not provided.
                    @endif
                    @if($user->address)
                        <h4>Address :</h4>
                        <p>{{ $user->address }}</p>
                     @else
                     <p></p>
                     <h4>Address :</h4>
                        <p>Address is not provided</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection