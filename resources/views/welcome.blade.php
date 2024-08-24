@extends('layout.app')

@section('main')
<link hidden rel="stylesheet" href="{{ asset('carousel/style.css') }}">

    <div class="container1">


        <div class="slide">

@foreach ($photos as $photo)

            <div class="item" style="background-image: url('{{ asset('uploads/photos/'.$photo->image) }}');">
                <div class="content">
                    <div class="name">{{ $photo->title }}</div>
                    <div class="des">{{ $photo->description }}</div>
                    <button style="background: transparent;"><a style="background: white;" class="btn" href="{{ route('photo.photo_index') }}">See more</a></button>
                </div>
            </div>

@endforeach


{{-- Testing --}}

{{-- End Testing --}}
        </div>

        <div class="button">
            <button class="prev"><i class="fa-solid fa-arrow-left"></i></button>
            <button class="next"><i class="fa-solid fa-arrow-right"></i></button>
        </div>

    </div>


    </div>


@endsection
