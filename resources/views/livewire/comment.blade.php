<div>
<button class="btn btn-comment d-flex  justify-content-center commentpop" onclick="togglepopup('popup-50')">
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
                <div class="popup" id="popup-50" wire:ignore.self>

                    <!-- <form action="{{route('comment_post')}}" method="post">
                        @csrf
                        <textarea name="write_comment" id="textarea_post" rows="1" placeholder="เขียนความคิดเห็น..." class="pt-3 pl-0 w-100" onfocus="update_textlen(this);" onblur="update_textlen(this);" onkeyup="update_textlen(this);"></textarea>
                        <div class="modal-footer pl-0 pr-0 pb-0">
                            <button wire:click="comment" type="submit" class="btn btn-secondary w-100 disabled" id="myclass">Send</button>
                        </div>
                    </form> -->

             
                        <textarea wire:keydown.enter="comment" class="card" id="ta" rows="1" name="write_comment" form="usrform" placeholder="เขียนความคิดเห็น..." onfocus="update_textlen(this);" onblur="update_textlen(this);" onkeyup="update_textlen(this);"></textarea>
                     
                   

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
