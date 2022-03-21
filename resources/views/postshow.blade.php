<x-app-layout>
   
</x-app-layout>
<div class="mt-2">
                <div class="card-body">
                    555555

                </div>
            </div>
            <div class="d-flex justify-content-between mt-1 liked-comment">
              
                <a class="liked cursor-pointer" data-toggle="modal" data-target="#likedModal" >

                    555555555


                </a>
         
         
              
                <a class="comment">5555555</a>
              
          
               
            </div>



            <div class="d-flex justify-content-between  border-bottom  border-top">
                <button class="btn btn-like d-flex  justify-content-center mr-2" >


                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="mr-2 svg-heart"

                        <path d=" M0 190.9V185.1C0 115.2 50.52 55.58 119.4 44.1C164.1 36.51 211.4 51.37 244 84.02L256 96L267.1 84.02C300.6 51.37 347 36.51 392.6 44.1C461.5 55.58 512 115.2 512 185.1V190.9C512 232.4 494.8 272.1 464.4 300.4L283.7 469.1C276.2 476.1 266.3 480 256 480C245.7 480 235.8 476.1 228.3 469.1L47.59 300.4C17.23 272.1 .0003 232.4 .0003 190.9L0 190.9z" />
                    </svg>
                    <span>
                        like
                    </span>

                </button>


                <button class="btn btn-comment d-flex  justify-content-center commentpop">
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
                <div class="popup popup-comment" >

                    <!-- <form action="{{route('comment_post')}}" method="post">
                        @csrf
                        <textarea name="write_comment" id="textarea_post" rows="1" placeholder="เขียนความคิดเห็น..." class="pt-3 pl-0 w-100" onfocus="update_textlen(this);" onblur="update_textlen(this);" onkeyup="update_textlen(this);"></textarea>
                        <div class="modal-footer pl-0 pr-0 pb-0">
                            <button wire:click="comment" type="submit" class="btn btn-secondary w-100 disabled" id="myclass">Send</button>
                        </div>
                    </form> -->
                    <div class="comment-textarea">

                        <a href="{{route('profile')}}">
                            <img class="comment-img-post" src="{{ Auth::user()->profile_photo_url }}" alt="profile">
                        </a>

                        <div class="spinner-grow" role="status" style="display: none;">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <textarea  class="card" id="text-comment" rows="1" name="write_comment" form="usrform" placeholder="เขียนความคิดเห็น..."></textarea>


                    </div>



            </div>