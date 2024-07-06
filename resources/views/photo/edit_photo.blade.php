@extends('layout.app')

@section('main')
    <div class="container">
        <div class="row my-5">
            <div class="col-md-3">
                <div class="card border-0 shadow-lg">
                    <div class="card-header  text-white">
                        Welcome, {{ Auth::user()->name }}
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            @if (Auth::user()->image != '')
                                <img src="{{ asset('uploads/profile/thumb/' . Auth::user()->image) }}"
                                    class="img-fluid rounded-circle" alt="Profile">
                            @else
                                <img width="150px" src="{{ asset('profile.jpg') }}" class="img-fluid rounded-circle"
                                    alt="Profile">
                            @endif
                        </div>
                        <div class="h5 text-center">
                            <strong>{{ Auth::user()->name }}</strong>
                            <p class="h6 mt-2 text-muted">5 Reviews</p>
                        </div>
                    </div>
                </div>
                <div class="card border-0 shadow-lg mt-3">
                    <div class="card-header  text-white">
                        Navigation
                    </div>
                    <div class="card-body sidebar">
                        @include('layout.sidebar')
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                @include('layout.message')
                <div class="card border-0 shadow">
                    <div class="card-header  text-white">
                        Edit Photo
                    </div>
                    <div class="card-body">
                        <form action="{{ route('photo.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" value="{{ old('title', $photo->title) }}"
                                    class="form-control @error('title') is-invalid @enderror" placeholder="Title"
                                    name="title" id="title" />

                                @error('title')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <input type="text" hidden name="id" id="id" value="{{ $photo->id }}">

                            <div class="mb-3">
                                <label for="author" class="form-label">Author</label>
                                <input type="text" value="{{ $photo->author }}" readonly
                                    class="form-control @error('author') is-invalid @enderror" placeholder="Author"
                                    name="author" id="author" />
                                @error('author')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="author" class="form-label">Location</label>
                                <input type="text" value="{{ old('location', $photo->location) }}"
                                    class="form-control @error('location') is-invalid @enderror" placeholder="Location"
                                    name="location" id="location" />
                                @error('location')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="author" class="form-label">Description</label>
                                <textarea value="{{ old('description') }}" name="description"
                                    id="description @error('description') is-invalid @enderror" class="form-control" placeholder="Description"
                                    cols="30" rows="5">{{ $photo->description }}</textarea>
                                @error('description')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="Image" class="form-label">Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image" id="image" />
                                @error('image')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror

                                @if (!empty($photo->image))
                                    <img class="mt-3" src="{{ asset('uploads/photos/thumb/' . $photo->image) }}"
                                        alt="">
                                @else
                                    <p class="text-danger m-2">No image found!</p>
                                @endif

                            </div>

                            <div class="mb-3">
                                <label for="author" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="0" {{ $photo->status == 0 ? 'selected' : '' }}>Active</option>
                                    <option value="1" {{ $photo->status == 1 ? 'selected' : '' }}>Block</option>
                                </select>
                            </div>

                            <button type="submit" name='submit' class="btn btn-primary mt-2">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
