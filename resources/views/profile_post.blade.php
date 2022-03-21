@foreach($posts as $post)
<div class="card mt-3">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <a href="{{route('profile')}}">
                <img class="profile-img-post" src="{{ $post->user->profile_photo_url }}" alt="profile">
            </a>
            <div class="user">
                <a href="{{route('profile')}}" class="ml-2 mb-0 username">{{ $post->user->name}}</a>
                <p class="ml-2 mb-0 userid">{{\Carbon\Carbon::parse( $post->created_at)->diffForHumans()}}</p>
            </div>
            <div class="dropleft list-icon">
                <a class="drop dt" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa-solid fa-ellipsis"></i>
                </a>
                <div class="dropdown-menu ">
                    <a class="dropdown-item" href="#">แก้ไขโพสต์</a>
                    <a class="dropdown-item text-danger" href="#">ลบโพสต์</a>
                </div>
            </div>
        </div>
        <div class="mt-2">
            <div class="card-body">
                {{ $post->whitten_post}}
            </div>
        </div>

        <div class="d-flex justify-content-between mt-1 liked-comment">
            <p class="liked">
                10k liked
            </p>
            <p class="comment">
                1k comment
            </p>
        </div>
        <script>
            function togglepopup() {
                var pop = document.getElementById("popup-1");
                pop.classList.toggle("active");
            }
        </script>
        <div class="d-flex justify-content-between  border-bottom  border-top">
            @livewire('like-post', ['LikePost' => $post->id])
            <button class="btn btn-comment d-flex  justify-content-center" onclick="togglepopup()">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="mr-2 svg-comment">
                    <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                    <path d="M256 32C114.6 32 .0272 125.1 .0272 240c0 49.63 21.35 94.98 56.97 130.7c-12.5 50.37-54.27 95.27-54.77 95.77c-2.25 2.25-2.875 5.734-1.5 8.734C1.979 478.2 4.75 480 8 480c66.25 0 115.1-31.76 140.6-51.39C181.2 440.9 217.6 448 256 448c141.4 0 255.1-93.13 255.1-208S397.4 32 256 32z" />
                </svg>
                <span>
                    comment
                </span>

            </button>
        </div>
        <div class="pop">
            <div class="popup" id="popup-1">
                <form action="#" method="#">
                    <textarea name="comment" id="textarea_post2" rows="1" placeholder="type something.." onfocus="update_textlen(this);" onblur="update_textlen(this);" onkeyup="update_textlen(this);"></textarea>
                </form>

                <div class="d-flex align-items-center">
                    <img class="profile-img-comment mr-1" src="https://cdn-icons-png.flaticon.com/512/1946/1946429.png" alt="profile">
                    <div class="card user-comment mt-2">
                        <p class="ml-2 mb-0 username">Username</p>
                        <p class="ml-2 mb-0 userid-comment">@userid</p>
                        <p class="comment-text ml-2 mr-2 mb-1">Lorem ipsum, dolor sit amet
                            consectetur</p>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <img class="profile-img-comment mr-1" src="https://cdn-icons-png.flaticon.com/512/1946/1946429.png" alt="profile">
                    <div class="card user-comment mt-2">
                        <p class="ml-2 mb-0 username">Username</p>
                        <p class="ml-2 mb-0 userid-comment">@userid</p>
                        <p class="comment-text ml-2 mr-2 mb-1">Lorem ipsum, dolor sit amet
                            consectetur Lorem ipsum dolor sit amet consectetur adipisicing
                            elit. At corporis eligendi sapiente illo? At atque doloremque
                            exercitationem adipisci assumenda veniam odit consequuntur provident,
                            maxime, doloribus cumque repellat harum, a quam.</p>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <img class="profile-img-comment mr-1" src="https://cdn-icons-png.flaticon.com/512/1946/1946429.png" alt="profile">
                    <div class="card user-comment mt-2">
                        <p class="ml-2 mb-0 username">Username</p>
                        <p class="ml-2 mb-0 userid-comment">@userid</p>
                        <p class="comment-text ml-2 mr-2 mb-1">Lorem ipsum, dolor sit amet
                            consectetur</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach