@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create an Event</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('events.store')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="categories" class="col-md-4 col-form-label text-md-right">Category</label>

                                <div class="col-md-6">
                                    <select name="category_id" class="form-control" id="inlineFormCustomSelect">
                                        <option value="" selected>---Category---</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>

                                <div class="col-md-6">
                                    <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="location" class="col-md-4 col-form-label text-md-right">Location</label>

                                <div class="col-md-6">
                                    <select name="location" class="form-control" id="inlineFormCustomSelect">
                                        <option value="" selected>---Location---</option>
                                        @foreach($locations as $code => $name)
                                            <option {{ $locations == $code ? 'selected' : '' }} value="{{ $code }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                      

                            <div class="form-group row">
                                <label for="eventdate" class="col-md-4 col-form-label text-md-right">Date of Event</label>

                                <div class="col-md-6">
                                    <input id="eventdate" type="date" class="form-control @error('eventdate') is-invalid @enderror" name="eventdate" value="{{ old('eventdate') }}" required autocomplete="eventdate" autofocus>
                                    @error('eventdate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="eventtype" class="col-md-4 col-form-label text-md-right">Type Of Event</label>

                                <div class="col-md-6">
                                    <select name="eventtype" class="form-control" id="inlineFormCustomSelect">
                                        <option value="" selected>---Type---</option>
                                        @foreach(\App\Event::EVENT_TYPE as $id => $type)
                                            @if(old('status') == $id)
                                                <option value="{{ $id }}" selected>{{ $type }}</option>
                                            @else
                                                <option value="{{ $id }}">{{ $type }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status" class="col-md-4 col-form-label text-md-right">Status</label>

                                <div class="col-md-6">
                                    <select name="status" id="inlineFormCustomSelect" class="form-control">
                                        <option value="" selected>---Status---</option>
                                        @foreach(\App\Event::STATUS_TYPE as $id => $type)
                                            @if(old('status') == $id)
                                                <option value="{{ $id }}" selected>{{ $type }}</option>
                                            @else
                                                <option value="{{ $id }}">{{ $type }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>

                                <div class="col-md-6">
                                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" required>

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            
                            <div class="form-group row">
                                <label for="website" class="col-md-4 col-form-label text-md-right">Official Website</label>

                                <div class="col-md-6">
                                    <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}" required autocomplete="website" autofocus>
                                    @error('website')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="images" class="col-md-4 col-form-label text-md-right">Image</label>

                                <div class="col-md-6">
                                    <input id="images" type="file" class="@error('images') is-invalid @enderror" name="images[]" multiple>

                                    @error('images')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection