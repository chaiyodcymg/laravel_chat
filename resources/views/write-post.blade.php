 <div class="write-post-container shadow-custom">
     <div class="user-profile-post">
         <img src="{{ Auth::user()->profile_photo_url }}" alt="#">

         <div class="post-input-container w-100">
             <button type="button" class="btn btn-light w-100 radius" id="showmodalpost" data-toggle="modal" data-target="#postmessage">คุณกำลังคิดอะไรอยู่</button>
             <div class="modal fade popup " id="postmessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                     <div class="modal-content postmodal">
                         <div class="modal-header d-flex justify-content-center p-2">
                             <h5 class="modal-title" id="exampleModalLabel">สร้างโพสต์</h5>
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
                             <form action="{{route('write_post')}}" method="post">
                                 @csrf
                                 <textarea name="whitten_post" id="textarea_post" rows="1" placeholder="คุณกำลังคิดอะไรอยู่" class="pt-3 pl-0 w-100" onfocus="update_textlen(this);" onblur="update_textlen(this);" onkeyup="update_textlen(this);"></textarea>
                                 <div class="modal-footer pl-0 pr-0 pb-0">
                                     <button type="submit" class="btn btn-secondary w-100 disabled" id="myclass">โพสต์</button>
                                 </div>
                             </form>
                         </div>
                     </div>
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
     function update_textlen(field) {
         var maxlen = 0;
         var fval = field.value;
         var flen = fval.length;
         var tlen = fval.replace(/\n/g, "\r\n").length;
         var dlen = tlen - flen;
         // console.log(field.value);
         if (!field.value || !field.value.trim()) {
             var button_class = document.getElementById('myclass').disabled = true;

             document.getElementById('myclass').className = "btn btn-secondary w-100 disabled";
             var button_class = document.getElementById('myclass').className;

         } else {
             document.getElementById('myclass').className = "btn btn-custom w-100";
             var button_class = document.getElementById('myclass').className;
             var button_class = document.getElementById('myclass').disabled = false;
         }
     }
     update_textlen(document.getElementById('textarea_post'));

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


   
     $("#myclass").click(function() {
        $('.spinner').modal('show');
        $('.postmodal').css('opacity','0.8')
         setTimeout(function() {
             
             $('.spinner').modal('hide');
         }, 1000);
     });
 </script>