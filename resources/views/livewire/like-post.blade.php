<div>
    @php $i = 0 @endphp

    @php $arr_check_like = array() @endphp

    @php
    $count_arr = 0;
    @endphp

    @php $likecount = 0 @endphp

    @php @endphp
    @foreach($posts as $post)
    <div class="modal modal-like-post w-100 " tabindex="-1" role="dialog" id="likedModal{{++$likecount}}" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header p-2 d-flex justify-content-center">
                    <h5 class="modal-title">จำนวนผู้ใช้ที่ถูกใจ</h5>
                    <button type="button" class="close m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="mr-3" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body like-body">
                    @foreach($post->postlikes as $like)

                    <a href="{{route('otheruser', ['user_id' => Crypt::encryptString($like->user->id)])}}" class="menu-sidebar ">

                        <img class="card-img-profile" src="{{ $like->user->profile_photo_url}}" alt="#">

                        <div class="card-body-menu">
                            <p class="card-title-menu pro-left"> {{$like->user->name}}</p>
                        </div>
                    </a>

                    @endforeach
                </div>
            </div>
        </div>
    </div>



    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <a href="{{route('profile')}}">
                    <img class="profile-img-post" src="{{ $post->user->profile_photo_url }}" alt="profile">
                </a>
                <div class="user">
                    @if($post->user->id == Auth::user()->id)
                    <a href="{{route('profile')}}" class="ml-2 mb-0 username">{{ $post->user->name}}</a>
                    @else
                    <a href="{{route('otheruser', ['user_id' => Crypt::encryptString($post->user->id)]) ;}}" class="ml-2 mb-0 username">{{ $post->user->name}}</a>
                    @endif
                    <p class="ml-2 mb-0 userid">{{\Carbon\Carbon::parse( $post->created_at)->diffForHumans()}}</p>
                </div>


                @if(Auth::user()->id == $post->user->id)
                <div class="dropleft list-icon" wire:ignore>
                    <a class="drop dt" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-solid fa-ellipsis" style="font-size: 20px !important;"></i>
                    </a>
                    <div class="dropdown-menu ">
                        <a class="dropdown-item text-danger" class="btn btn-primary" data-toggle="modal" data-target="#deleteModal">ลบโพสต์</a>
                    </div>

                    <div class="modal-delete-post w-100">
                        <div class="modal" tabindex="-1" role="dialog" id="deleteModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" wire:ignore.self>
                                    <div class="modal-header p-2 d-flex justify-content-center">
                                        <h5 class="modal-title">ลบโพสต์</h5>
                                        <button type="button" class="close m-0 p-0" data-dismiss="modal" aria-label="Close">
                                            <span class="mr-3" aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body pt-4 pb-4">
                                        <p class="m-0 text-center">คุณต้องการลบโพสต์หรือไม่ หากลบแล้วคุณจะไม่สามารถกู้คืนได้</p>
                                    </div>
                                    <div class="modal-footer p-1">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                                        <a href="{{route('delete', ['id'=> Crypt::encryptString($post->id)]);}}"><button type="button" class="btn btn-danger w-100" wire:poll.visible>ลบโพสต์</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                @endif
            </div>
            <div class="mt-2">
                <div class="card-body">
                    {{ $post->whitten_post}}

                </div>
            </div>
            <div class="d-flex justify-content-between mt-1 liked-comment">
                @if(count($post->postlikes) != 0)
                <a class="liked cursor-pointer" data-toggle="modal" data-target="#likedModal{{$likecount}}" wire:poll.keep-alive>

                    {{count($post->postlikes)}} liked


                </a>
                @else
                <div></div>
                @endif
                <a class="comment">1k comment</a>
            </div>



            <div class="d-flex justify-content-between  border-bottom  border-top">
                <button class="btn btn-like d-flex  justify-content-center mr-2" wire:click="UserLikePost('{{Crypt::encryptString($post->id)}}')">


                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="mr-2 svg-heart" @foreach($post->postlikes as $like)

                        @if($like->user->id == Auth::user()->id)

                        style="fill:rgb(255, 99, 71);"
                        @endif
                        @endforeach
                        >

                        <path d=" M0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L256 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 .0003 232.4 .0003 190.9L0 190.9z" />
                    </svg>
                    <span>
                        like
                    </span>

                </button>
                <script></script>

                </script>

                <button class="btn btn-comment d-flex  justify-content-center commentpop" onclick="togglepopup('popup-{{$i++}}')">
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
                <div class="popup" id="popup-{{$i-1}}" wire:ignore.self>

                    <!-- wire:click="comment" -->
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
</div>