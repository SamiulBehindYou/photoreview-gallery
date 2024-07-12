@extends('layout.app')

@section('main')
<link hidden rel="stylesheet" href="{{ asset('carousel/style.css') }}">

    <div class="container1">


        <div class="slide">


            <div class="item" style="background-image: url(https://i.ibb.co/qCkd9jS/img1.jpg);">
                <div class="content">
                    <div class="name">Switzerland</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                    <button style="background: transparent;"><a style="background: white;" class="btn" href="{{ route('photo.photo_index') }}">See more</a></button>
                </div>
            </div>
            <div class="item" style="background-image: url(https://i.ibb.co/jrRb11q/img2.jpg);">
                <div class="content">
                    <div class="name">Finland</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                    <button style="background: transparent;"><a style="background: white;" class="btn" href="{{ route('photo.photo_index') }}">See more</a></button>
                </div>
            </div>
            <div class="item" style="background-image: url(https://i.ibb.co/NSwVv8D/img3.jpg);">
                <div class="content">
                    <div class="name">Iceland</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                    <button style="background: transparent;"><a style="background: white;" class="btn" href="{{ route('photo.photo_index') }}">See more</a></button>
                </div>
            </div>
            <div class="item" style="background-image: url(https://i.ibb.co/Bq4Q0M8/img4.jpg);">
                <div class="content">
                    <div class="name">Australia</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                    <button style="background: transparent;"><a style="background: white;" class="btn" href="{{ route('photo.photo_index') }}">See more</a></button>
                </div>
            </div>
            <div class="item" style="background-image: url(https://i.ibb.co/jTQfmTq/img5.jpg);">
                <div class="content">
                    <div class="name">Netherland</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                    <button style="background: transparent;"><a style="background: white;" class="btn" href="{{ route('photo.photo_index') }}">See more</a></button>
                </div>
            </div>
            <div class="item" style="background-image: url(https://i.ibb.co/RNkk6L0/img6.jpg);">
                <div class="content">
                    <div class="name">Ireland</div>
                    <div class="des">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ab, eum!</div>
                    <button style="background: transparent;"><a style="background: white;" class="btn" href="{{ route('photo.photo_index') }}">See more</a></button>
                </div>
            </div>

        </div>

        <div class="button">
            <button class="prev"><i class="fa-solid fa-arrow-left"></i></button>
            <button class="next"><i class="fa-solid fa-arrow-right"></i></button>
        </div>

    </div>


    </div>


@endsection
