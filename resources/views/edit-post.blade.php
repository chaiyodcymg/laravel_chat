<div class="modal-delete-post w-100">
    <div class="modal" tabindex="-1" role="dialog" id="editModal{{++$i}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content" wire:ignore.self>
                <div class="modal-header p-2 d-flex justify-content-center">
                    <h5 class="modal-title">แก้ไขโพสต์</h5>
                    <button type="button" class="close m-0 p-0" data-dismiss="modal" aria-label="Close">
                        <span class="mr-3" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="user-profile-post">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="#">
                        <div>
                            <p>{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                    <form action="{{route('edit',$post->id)}}" method="post">
                        @csrf
                        <textarea name="whitten_post" id="textarea_post" rows="3" placeholder="คุณกำลังคิดอะไรอยู่" value="{{$post->whitten_post}}" class="pt-3 pl-0 w-100" onfocus="update_textlen(this);" onblur="update_textlen(this);" onkeyup="update_textlen(this);">{{$post->whitten_post}}</textarea>
                        <div class="modal-footer pl-0 pr-0 pb-0">
                            <button type="submit" class="btn btn-secondary w-100 disabled" id="myclass">โพสต์</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>