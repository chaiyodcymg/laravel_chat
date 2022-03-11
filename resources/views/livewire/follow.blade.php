<div>
    @php @endphp
    <div class="d-flex justify-content-center">
        <img class="profile-img mt-5 " src="{{$users[0]->profile_photo_url}}" alt="profile">
    </div>
    <div class="d-flex justify-content-center mt-3">
        <h3></h3>
    </div>
    <div class="d-flex justify-content-center">
        <p>follower: {{count($users[0]->followers)}}</p>
        <p class="ml-2">following: {{count($users[0]->followings)}}</p>
    </div>
    <div class="d-flex justify-content-center">

        @if($users[0]->id == Auth::user()->id)
        <a class="link-editprofile btn bt" href="{{route('profile.show')}}">Setting</a>
        @else

                <a class="link-editprofile btn bt" wire:click="following">follow</a>




                <a class="fill-message ml-2 bt btn" href="{{route('userchat', ['id' => Crypt::encryptString($users[0]->id)]) ;}}">
                    <svg class="message-button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                        <path d="M448 64H64C28.65 64 0 92.65 0 128v256c0 35.35 28.65 64 64 64h384c35.35 0 64-28.65 64-64V128C512 92.65 483.3 64 448 64zM64 112h384c8.822 0 16 7.178 16 16v22.16l-166.8 138.1c-23.19 19.28-59.34 19.27-82.47 .0156L48 150.2V128C48 119.2 55.18 112 64 112zM448 400H64c-8.822 0-16-7.178-16-16V212.7l136.1 113.4C204.3 342.8 229.8 352 256 352s51.75-9.188 71.97-25.98L464 212.7V384C464 392.8 456.8 400 448 400z" />
                    </svg>
                </a>
        @endif
    </div>
</div>