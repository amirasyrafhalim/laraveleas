@extends('layouts.app')

@section ('content')
    <div class="container">
        <div class="media border p-3">
            <img src="{{ $user->getAvatar() }}"  alt="{{ $user->name }}" class="img-thumbnail" style = "max-width:200px">
        </div>
    </div>
@endsection
