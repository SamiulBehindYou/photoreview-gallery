@extends('layout.app')

@section('main')

    <div class="container mt-3 pb-5">
        <div class="row justify-content-center d-flex mt-5">
            <div class="col-md-12">
                {{-- <div class="d-flex justify-content-between">
                    <h2 class="mb-3">Photos</h2>
                    <div class="mt-2">
                        <a href="#" class="text-dark">Clear</a>
                    </div>
                </div>
                <div class="card shadow-lg border-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-11 col-md-11">
                                <input type="text" class="form-control form-control-lg" placeholder="Search by title">
                            </div>
                            <div class="col-lg-1 col-md-1">
                                <button class="btn btn-primary btn-lg w-100"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </div>
                    </div>
                </div> --}}


                <div class="row mt-4">

                    @foreach ($photos as $photo)

                        {{-- @if ($photo->status == 0) --}}

                            <div class="col-md-4 col-lg-3 mb-4">
                                <div class="card border-0 shadow-lg">
                                    <a href="{{ route('photo.photo_details', $photo->id) }}">
                                        @if ($photo->image == '')
                                            <img src="{{ asset('uploads/photos/thumb/notavailablephoto.jpg') }}" class="img-fluid rounded-circle" alt="photo" class="card-img-top">
                                        @else
                                            <img src="{{ asset('uploads/photos/thumb/'.$photo->image) }}" alt="" class="card-img-top">
                                        @endif
                                    </a>
                                    <div class="card-body">
                                        <h3 class="h4 heading"><a href="#">{{ $photo->title }}</a></h3>
                                        <p>by {{ $photo->author }}</p>
                                        <div class="star-rating d-inline-flex ml-2" title="">
                                            <span class="rating-text theme-font theme-yellow">5.0</span>
                                            <div class="star-rating d-inline-flex mx-2" title="">
                                            </div>
                                            <span class="theme-font text-muted">(2 Reviews)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- @endif --}}

                    @endforeach





                    <nav aria-label="Page navigation " >
                        {{ $photos->links('pagination::bootstrap-4') }}
                      </nav>

                </div>
            </div>
        </div>
    </div>

@endsection
