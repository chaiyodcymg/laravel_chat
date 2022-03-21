<div class="modal-delete-post w-100" wire:ignore>
    <div class="modal" tabindex="-1" role="dialog" id="editModal{{++$i}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content postmodal" wire:ignore.self>
                <div class="modal-header p-2 d-flex justify-content-center">
                    <h5 class="modal-title">Edit post</h5>
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
                        <textarea name="whitten_post" id="textarea_post" rows="3" placeholder="{{$post->whitten_post}}" value="{{$post->whitten_post}}" class="pt-3 pl-0 w-100" onfocus="delete_post(this);" onblur="delete_post(this);" onkeyup="delete_post(this);">{{$post->whitten_post}}</textarea>
                        <div class="modal-footer pl-0 pr-0 pb-0">
                            <button type="submit" class="btn btn-secondary w-100 disabled" id="editpost">Edit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg spinner" data-backdrop="static" data-keyboard="false" tabindex="-1" role="status">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="width: 48px">
            <span class="spinner-border "></span>
        </div>
    </div>
</div>
<script>
    function delete_post(field) {
        var maxlen = 0;
        var fval = field.value;
        var flen = fval.length;
        var tlen = fval.replace(/\n/g, "\r\n").length;
        var dlen = tlen - flen;
        // console.log(field.value);
        if (!field.value || !field.value.trim()) {
            var button_class = document.getElementById('editpost').disabled = true;

            document.getElementById('editpost').className = "btn btn-secondary w-100 disabled";
            var button_class = document.getElementById('editpost').className;

        } else {
            document.getElementById('editpost').className = "btn btn-custom w-100";
            var button_class = document.getElementById('editpost').className;
            var button_class = document.getElementById('editpost').disabled = false;
        }
    }
    delete_post(document.getElementById('textarea_post'));

    function adjust() {
        var style = this.currentStyle || window.getComputedStyle(this);
        var boxSizing = style.boxSizing === 'border-box' ?
            parseInt(style.borderBottomWidth, 10) +
            parseInt(style.borderTopWidth, 10) :
            0;
        this.style.height = '';
        this.style.height = (this.scrollHeight + boxSizing) + 'px';
    };

    var textarea = document.getElementById("textarea_post");
    if ('onpropertychange' in textarea) { // IE
        textarea.onpropertychange = adjust;
    } else if ('oninput' in textarea) {
        textarea.oninput = adjust;
    }
    setTimeout(adjust.bind(textarea));



    $("#editpost").click(function() {
        $('.spinner').modal('show');
        $('.postmodal').css('opacity', '0.8')
        setTimeout(function() {

            $('.spinner').modal('hide');
        }, 3000);
    });
</script>