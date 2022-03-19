<div>
    @php \Carbon\Carbon::setLocale('th'); @endphp
    <div class="container-fluid">
        <div class="row  row-in-container ">

            <div class=" box-card-all">
                <div class=" box-list-user">
                    <div class="card card-list-user" wire:poll.keep-alive>
                        <div class="card-header text-center">
                            {{Auth::user()->name}}
                        </div>

                        <div class="box-in-card-list-user">
                            <!-- ************************************************************************************* -->
                            @foreach($users as $user)

                            @if($user->id !== Auth::user()->id)

                            <a href="{{route('userchat', ['id' => Crypt::encryptString($user->id)]) ;}}">
                                <div class="card card_img_profile">
                                    <img class="card-img rounded-circle" src="{{ $user->profile_photo_url }}" alt="Card image">
                                    @if($user->is_online==true)
                                    <div class="card-img-overlay">
                                        <div class="dot"></div>
                                    </div>
                                    @endif
                                    <div class="text-card-profile">
                                        <span class="name-text-card-profile"> {{$user->name}}</span>

                                        @php
                                        $mes= App\Models\Message::where('user_id',$user->id)->where('receiver_id',Auth::user()->id)->orderBy('id', 'desc')->first();

                                        @endphp

                                        <div class="message-card-profile  text-truncate">

                                            @if(filled($mes))

                                            @if( $mes->is_seen == 1)

                                            @if($user->is_online==true)
                                            <span class="status-text-card-profile"> กำลังใช้งาน</span>


                                            @else
                                            <span class="status-text-card-profile">ใช้งานเมื่อ {{\Carbon\Carbon::parse($user->last_activity)->diffForHumans()}}</span>
                                            @endif
                                            @else
                                            <span class="msg-card-profile ">{{$mes->message}} : </span>
                                            @if($user->is_online==true)
                                            <span class="status-text-card-profile">{{\Carbon\Carbon::parse($mes->created_at)->diffForHumans()}}</span>
                                            @else
                                            <span class="status-text-card-profile">ใช้งานเมื่อ {{\Carbon\Carbon::parse($user->last_activity)->diffForHumans()}}</span>
                                            @endif
                                            @endif
                                            @else
                                            @if($user->is_online==true)
                                            <span class="status-text-card-profile"> กำลังใช้งาน</span>
                                            @else
                                            <span class="status-text-card-profile">ใช้งานเมื่อ {{\Carbon\Carbon::parse($user->last_activity)->diffForHumans()}}</span>
                                            @endif
                                            @endif
                                        </div>


                                    </div>

                                </div>
                            </a>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>


                <!-- ************************************************************************ -->
                <div class=" box-chat">
                    @if(filled($allmessages) || $get_user_to_chat == true)
                    <div class="card card-chat">

                        <div class="card-header">
                            @if(isset($sender)) {{$sender->name}} @endif

                        </div>

                        <div class="card-body message-box" id="message-box" wire:poll=" mountdata">

                            @php $count = 0 @endphp
                            @foreach($allmessages as $mgs)
                            @php
                            $msg= App\Models\Message::where('user_id',auth()->id())->where('receiver_id',$mgs['receiver_id'])->orderBy('id', 'desc')->first();

                            @endphp


                            @if($mgs['user_id'] == Auth::user()->id)
                            <div class="box_img_right">

                                <div class="single-message sent" data-toggle="tooltip" data-placement="left" title="{{\Carbon\Carbon::parse($mgs['created_at'])->diffForHumans()}}">

                                    {{ $mgs['message']}}

                                </div>
                                @php @endphp
                                @if($mgs->is_seen == 1)

                                @if($count == 0)
                                <span class="seen">
                                    เห็นแล้ว
                                </span>
                                @php $count++ @endphp
                                @endif
                                @endif

                            </div>
                            @else

                            <div class="box_img_left">
                                <div class="box_img_in_chat">

                                    <img class="img_in_chat" data-toggle="tooltip" data-placement="left" title="" src="{{ $mgs['user'][0]['profile_photo_url'] }}" alt="">


                                </div>
                                <div class="single-message received" data-toggle="tooltip" data-placement="left" title="{{\Carbon\Carbon::parse($mgs['created_at'])->diffForHumans()}}">

                                    {{ $mgs['message']}}

                                </div>

                            </div>

                            @endif

                            @endforeach

                            <!--******************* spinner ************************-->
                            <div class="d-flex justify-content-center" id="spinner" style=" display:none  !important;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <!--******************* spinner ************************-->
                        </div>

                        <div class="card-footer">
                            <form wire:submit.prevent="SendMessage">
                                @csrf
                                <div class="row">
                                    <div class="col-md-10">
                                        <input wire:model="message" class="form-control input shadow-none w-100 d-inline-block" placeholder="Type a message" required>
                                    </div>

                                    <div class="col-md-2 d-flex  align-items-center">
                                        <button type="submit" class="btn   d-flex  align-items-center"><i class="far fa-paper-plane mt-0"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
                @else

                <div class="card card-chat">

                    <div class="card-body message-box" id="message-box" style="overflow: hidden;">

                    </div>
                </div>



                @endif
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function adjust() {
        var style = this.currentStyle || window.getComputedStyle(this);
        var boxSizing = style.boxSizing === 'border-box' ?
            parseInt(style.borderBottomWidth, 10) +
            parseInt(style.borderTopWidth, 10) :
            0;
        this.style.height = '';
        this.style.height = (this.scrollHeight + boxSizing) + 'px';
    };
    var textarea = document.getElementById("textarea-send-message");
    if ('onpropertychange' in textarea) { // IE
        textarea.onpropertychange = adjust;
    } else if ('oninput' in textarea) {
        textarea.oninput = adjust;
    }

    setTimeout(adjust.bind(textarea));
    $('#message-box').on('scroll', function() {
        height = (Math.abs($(this).scrollTop()) + $(this).innerHeight()) + 2
        if (height >= $(this)[0].scrollHeight) {
            $("#spinner").css('display', 'flex');
            window.livewire.emit('load-more');
        }
    })
</script>