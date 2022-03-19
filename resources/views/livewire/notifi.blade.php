<div>

    <li class="nav-item notifi-icon " wire:click="$emit('read_noti')">
        <a class="notifi-all nav-link">
            <!-- <div class=" fa-solid fa-bell overlay "></div> -->
            <svg class="svg-bell" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" wire:ignore.self>
                <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                <path d="M256 32V51.2C329 66.03 384 130.6 384 208V226.8C384 273.9 401.3 319.2 432.5 354.4L439.9 362.7C448.3 372.2 450.4 385.6 445.2 397.1C440 408.6 428.6 416 416 416H32C19.4 416 7.971 408.6 2.809 397.1C-2.353 385.6-.2883 372.2 8.084 362.7L15.5 354.4C46.74 319.2 64 273.9 64 226.8V208C64 130.6 118.1 66.03 192 51.2V32C192 14.33 206.3 0 224 0C241.7 0 256 14.33 256 32H256zM224 512C207 512 190.7 505.3 178.7 493.3C166.7 481.3 160 464.1 160 448H288C288 464.1 281.3 481.3 269.3 493.3C257.3 505.3 240.1 512 224 512z" />
            </svg>
            @php $count = 0 @endphp
            @php $count_loop = 0 @endphp
            @php @endphp
            <span wire:poll.keep-alive>
                @if(count($noti) > 0)
                <span class="notifi ">


                    {{count($noti) }}
                </span>
                @endif
            </span>
        </a>

        <div class="container" id="notification-popup" wire:ignore.self>
            <div class="nonti-position">
                <div class="col absolute z-50 w-48 rounded-md origin-top-right right-0 nonti-inside" wire:poll.visible>
                    <div class="noti-new">
                        <b>แจ้งเตือน</b>
                    </div>
                    @foreach($list_notis as $list_noti)
                    @php  @endphp
                    @if($list_noti->message_data == "กดติดตามคุณ")
                    <a href="{{route('otheruser', ['user_id' => Crypt::encryptString($list_noti->user->id)])}}" class="menu-sidebar noti">
                        <img class="card-img-profile-notifi" src="{{$list_noti->user->profile_photo_url}}" alt="#">
                        <div class="card-body-menu">
                            <small class="card-title-menu">{{$list_noti->user->name}}</small>
                            <small class="card-title-menu">{{$list_noti->message_data}}</small><br>
                            <small class="card-color">{{\Carbon\Carbon::parse( $list_noti->created_at)->diffForHumans()}}</small>
                        </div>
                    </a>
                    @else
                    <a href="{{route('postshow', ['id' => Crypt::encryptString($list_noti->post_id)]) ;}}" class="menu-sidebar noti">
                        <img class="card-img-profile-notifi" src="{{$list_noti->user->profile_photo_url}}" alt="#">
                        <div class="card-body-menu">
                            <small class="card-title-menu">{{$list_noti->user->name}}</small>
                            <small class="card-title-menu">{{$list_noti->message_data}}</small><br>
                            <small class="card-color">{{\Carbon\Carbon::parse( $list_noti->created_at)->diffForHumans()}}</small>
                        </div>
                    </a>
                    @endif
                    @endforeach

                </div>
            </div>
        </div>


    </li>

</div>


<script>
    $(document).ready(function() {


        $('.notifi-icon').click(function(e) {

            if ($(".svg-bell").css("fill") == "rgb(191, 191, 191)") {
                $(".svg-bell").css("fill", "#ff6347");

            } else {
                $(".svg-bell").css("fill", "#bfbfbf");
            }

            e.stopPropagation(); // when you click the button, it stops the page from seeing it as clicking the body too
            $('#notification-popup').toggle();

            $('#dropprofile').hide();
        });

        $('.test').click(function(e) {
            e.stopPropagation();
            $('#dropprofile').toggle();
            $('#notification-popup').hide();
            $(".svg-bell").css("fill", "#bfbfbf");
        });


        $(document).click(function() {

         
            if ($('#notification-popup').css('display') == 'block') {
                        // alert('โชว?');
                $('.notifi-icon').trigger("click");
                $(".svg-bell").css("fill", "#bfbfbf");
            }



        });



    });
</script>