<div>
    @php \Carbon\Carbon::setLocale('th'); @endphp
	<div class="container-fluid">
    <div class="row  row-in-container ">
       
    <div class=" box-card-all">

     <div class="card card-list-user" wire:poll.keep-alive>
        <div class="card-header text-center">
            {{Auth::user()->name}}
        </div>

         @foreach($users as $user)
         @if($user->id !== Auth::user()->id)
          @php
          
           $not_seen= App\Models\Message::where('user_id',$user->id)->where('receiver_id',Auth::user()->id)->get()
           
          
            @endphp
              
            <div class="card card_img_profile" wire:click="getUser({{$user->id}})" >
                <img class="card-img rounded-circle" src="https://scontent.fkkc3-1.fna.fbcdn.net/v/t39.30808-6/265037037_4583606948423513_6845078172086085211_n.jpg?_nc_cat=109&ccb=1-5&_nc_sid=09cbfe&_nc_eui2=AeFnJMFayYs-lTj0LeL1-vEmgXLU6bpkhRuBctTpumSFG9qq3aIGeq5SvvL3cIwfb3YPPtjfyTfdKhXMJ9l1PgIu&_nc_ohc=x7xGYsvKr6cAX_GVzDK&_nc_ht=scontent.fkkc3-1.fna&oh=00_AT96U0KaLWH2qngc5X1_XtUKdc9KWrNi3V5Z3RgXtIs_-g&oe=6206F38E" alt="Card image" >
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
                                            <span class="status-text-card-profile">ใช้งานเมื่อ  {{\Carbon\Carbon::parse($user->last_activity)->diffForHumans()}}</span>
                                    @endif   
                                @else   
                                 <span class="msg-card-profile ">{{$mes->message}} : </span>
                                        @if($user->is_online==true)
                                            <span class="status-text-card-profile">{{\Carbon\Carbon::parse($mes->created_at)->diffForHumans()}}</span> 
                                        @else 
                                         <span class="status-text-card-profile">ใช้งานเมื่อ  {{\Carbon\Carbon::parse($user->last_activity)->diffForHumans()}}</span>
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
             @endif
              @endforeach
       
        </div>
        
              
       
            <!-- <div class="  box-list-user">
                <div class="card card-list-user">
                    <div class="card-header">
                       {{Auth::user()->name}}
                    </div>
                    <div class="card-body chatbox p-0" wire:poll.keep-alive>
                        <ul class="list-group list-group-flush">
                          @foreach($users as $user)

                          @if($user->id !== auth()->id())
                          @php
                              $not_seen= App\Models\Message::where('user_id',$user->id)->where('receiver_id',auth()->id())->where('is_seen',false)->get() ?? null

                          @endphp
                           
                                <a wire:click="getUser({{$user->id}})"  class="text-dark link">
                                    <li class="list-group-item">
                                        <img class="img-fluid avatar" src="https://cdn.pixabay.com/photo/2017/06/13/12/53/profile-2398782_1280.png">
                                        @if($user->is_online==true)

                                         <i class="fa fa-circle text-success online-icon">
                                            @endif
                                             
                                         </i> {{$user->name}}
                                       @if(filled($not_seen))
                                            <div class="badge badge-success rounded"> {{ $not_seen->count()}} </div>
                                            @endif
                                    </li>
                                </a>
                                @endif
                          @endforeach
                        </ul>
                    </div>
                </div>
            </div> -->
  <!-- ************************************************************************ -->
        <div class=" box-chat">
              @if(filled($allmessages) || $get_user_to_chat == true)
            <div class="card card-chat">
              
                <div class="card-header">
                     @if(isset($sender)) {{$sender->name}}   @endif
                </div>
                <div class="card-body message-box" wire:poll="mountdata">
                   @php $count = 0 @endphp
                     @foreach($allmessages as $mgs)
                      @php
                              $msg= App\Models\Message::where('user_id',auth()->id())->where('receiver_id',$mgs->receiver_id)->orderBy('id', 'desc')->first();
                            
                          @endphp
                     @if($mgs->user_id == Auth::user()->id)  
                     <div class="box_img_right">
                        
                            <div class="single-message sent" data-toggle="tooltip" data-placement="left" title="{{\Carbon\Carbon::parse($mgs->created_at)->diffForHumans()}}">
                             
                              {{ $mgs->message}}
                              
                            </div>
                            @php  @endphp
                                @if($msg->is_seen == 1)

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
                                <img class="img_in_chat" data-toggle="tooltip" data-placement="left" title="{{$mgs->user->name}}" src="https://scontent.fkkc3-1.fna.fbcdn.net/v/t39.30808-6/265037037_4583606948423513_6845078172086085211_n.jpg?_nc_cat=109&ccb=1-5&_nc_sid=09cbfe&_nc_eui2=AeFnJMFayYs-lTj0LeL1-vEmgXLU6bpkhRuBctTpumSFG9qq3aIGeq5SvvL3cIwfb3YPPtjfyTfdKhXMJ9l1PgIu&_nc_ohc=x7xGYsvKr6cAX_GVzDK&_nc_ht=scontent.fkkc3-1.fna&oh=00_AT96U0KaLWH2qngc5X1_XtUKdc9KWrNi3V5Z3RgXtIs_-g&oe=6206F38E" alt="">
                          </div>
                         <div class="single-message received" data-toggle="tooltip" data-placement="left" title="{{\Carbon\Carbon::parse($mgs->created_at)->diffForHumans()}}">
                             
                              {{ $mgs->message}}
                              
                            </div>

                     </div>
                     
                     @endif

                            @endforeach
                           
                        
                </div>
                 
                <div class="card-footer">
                    <form wire:submit.prevent="SendMessage">
                        <div class="row">
                            <div class="col-md-8">
                                <input wire:model="message" class="form-control input shadow-none w-100 d-inline-block" placeholder="Type a message" required>
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary d-inline-block w-100"><i class="far fa-paper-plane"></i> Send</button>
                            </div>
                        </div>
                    </form>
                </div>
             
            </div>
             
        </div>
        @endif
    </div>
    </div>
</div>
</div>
