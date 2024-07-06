
    <ul class="nav flex-column">

        @if (Auth::User()->role == 'user')
            <li class="nav-item">
                <a href="{{ route('photo.see_photo') }}">Photos</a>
            </li>
            <li class="nav-item">
                <a href="reviews.html">Reviews</a>
            </li>
        @endif

        <li class="nav-item">
            <a href="{{ route('account.profile') }}">Profile</a>
        </li>
        <li class="nav-item">
            <a href="my-reviews.html">My Reviews</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('photo.createpost') }}">Create post</a>
        </li>
        <li class="nav-item">
            <a href="change-password.html">Change Password</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('account.logout') }}">Logout</a>
        </li>
    </ul>

