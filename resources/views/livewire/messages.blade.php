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

         @foreach($users as $user)
         @if($user->id !== Auth::user()->id)
          @php
          
           $not_seen= App\Models\Message::where('user_id',$user->id)->where('receiver_id',Auth::user()->id)->get()
           
          
            @endphp
              
            <div class="card card_img_profile" wire:click="getUser({{$user->id}})" >
                <img class="card-img rounded-circle" src="{{ asset($user->image_profile) }}" alt="Card image" >
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
        </div>
              

  <!-- ************************************************************************ -->
        <div class=" box-chat">
              @if(filled($allmessages) || $get_user_to_chat == true)
            <div class="card card-chat">
              
                <div class="card-header">
                     @if(isset($sender)) {{$sender->name}}   @endif
                      
                </div>
               
                <div class="card-body message-box" id="message-box" onscroll="load_scroll()" wire:poll=" mountdata">
                  
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
                                <img class="img_in_chat" data-toggle="tooltip" data-placement="left" title="{{$mgs['user']['name']}}" src="{{ asset($mgs['user']['image_profile']) }}" alt="">
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
   
     function load_scroll(){
     let div_scroll =  document.getElementById("message-box");
       let  scroll_1 =  div_scroll.scrollHeight;
        let  scroll_2 =  Math.abs(div_scroll.scrollTop)+487;
        // console.log(scroll_2);
        if(scroll_1  <= scroll_2){
            //    console.log("เข้า");
            //    console.log(scroll_1);
               document.getElementById("spinner").style.display="flex ";
                window.livewire.emit('load-more');
                // let spinner =  document.getElementById("spinner").style.display="none ";
         }
        }
    </script>
