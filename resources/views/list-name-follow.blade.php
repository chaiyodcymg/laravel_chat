<div class="left-sidebar col-4 col-sm-4 col-md-3">
    <a href="{{route('profile')}}" class="left-profile">
        <div class="user-profile">
            <img src="{{ Auth::user()->profile_photo_url }}" alt="#">
            <div class="profile-left ">
                <p class="pro-left">{{ Auth::user()->name }}</p>
            </div>
        </div>
    </a>
    <div class="shortcut-links pt-3 ml-3 mr-3">

        <p class="m-0 pb-2">Following </p>
   

    </div>
    <div class="imp-links">

        @foreach($followings as $following)

        @php  @endphp
        @if($following->user->id !== Auth::user()->id)
        <a href="{{route('otheruser', ['user_id' => Crypt::encryptString($following->user->id)])}}" class="menu-sidebar ">

            <img class="card-img-profile" src="{{ $following->user->profile_photo_url}}" alt="#">

            <div class="card-body-menu">
                <p class="card-title-menu pro-left">{{$following->user->name}}</p>
            </div>
        </a>
        @endif
        @endforeach
    </div>
</div>