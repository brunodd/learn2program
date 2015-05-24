@foreach($users as $user)
    <div class="user">
        <div class="userimage" onclick="location.href='{{ action('UsersController@show', $user->username )}}'">
            <img src="/images/users/{{ $user->image }}" alt="Profile Picture">
        </div>
        <div class="userdata">
            <a href="{{ action('UsersController@show', $user->username )}}">{{ $user->username }}</a>
            <div class="aboutuser">{!! strip_tags($user->info) !!}</div>
        </div>
        <div style="clear: both;"></div>
    </div>
    <div style="clear: both;"></div>
@endforeach
