@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Are you sure you want to join {{ $event->title }} ?</div>
                    <div class="card-body">
                        <form method="POST" action="/{{ $event->slugWithPrefix() }}/apply">
                            @csrf
                            <div class="form-group row mb-0">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-lg btn-primary">
                                        Yes
                                    </button>
                                </div>
                            </div>
                        </form>
                        <p></p><p></p>
                        <form class="input-group mb-3" method="GET" action="/home">
                            <button type="submit" class="btn  btn-lg  btn-danger">No</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection