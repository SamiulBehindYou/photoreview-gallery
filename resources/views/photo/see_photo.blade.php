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
                        @if(Auth::user()->image != "")
                            <img src="{{ asset('uploads/profile/thumb/'.Auth::user()->image) }}" class="img-fluid rounded-circle" alt="Profile">
                        @else
                            <img width="150px" src="{{ asset('profile.jpg') }}" class="img-fluid rounded-circle" alt="Profile">
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

            <div class="card border-0 shadow">
                <div class="card-header  text-white">
                    Photos
                </div>
                <div class="card-body pb-0">
                    <a href="{{ route('photo.createpost') }}" class="btn btn-primary">Add Photo</a>
                    <table class="table  table-striped mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th width="150">Action</th>
                            </tr>
                            <tbody>
                                @foreach ($photos as $photo)

                                <tr>
                                    <td>{{ $photo->title }}</td>
                                    <td>{{ $photo->author }}</td>
                                    <td>3.0 (3 Reviews)</td>
                                    <td>
                                        @if ($photo->status == 0)
                                            Active
                                        @else
                                            Block
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-success btn-sm"><i class="fa-regular fa-star"></i></a>
                                        <a href="{{ route('photo.editpost', $photo->id) }}" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                                        <a href="" onclick="deletePhoto({{$photo->id}});" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </thead>
                    </table>
                    <nav aria-label="Page navigation " >

                        {{ $photos->links('pagination::bootstrap-4') }}

                      </nav>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection

@section('script')


<script>
    function deletePhoto(id) {
        if (confirm("Are you sure you want to delete?")) {
            $.ajax({
                url: '{{ route("photo.destroy") }}',
                type: 'DELETE',
                data: { id: id },
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                success: function(response) {
                    window.location.href = '{{ route("photo.see_photo") }}';
                }
            });
        }
    }
</script>


@endsection
