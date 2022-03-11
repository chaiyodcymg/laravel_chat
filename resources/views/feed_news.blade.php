<x-app-layout>

</x-app-layout>
<div class="container">
  <!-- lefr-sidebar -->
  <div class="row">
    <!-- หน้ารายชื่อคนติดตาม -->
    @include('list-name-follow')
    <!-- หน้ารายชื่อคนติดตาม -->

    <!-- main-content -->
    <div class="main-content col-12 col-sm-8 col-md-9">
      <!-- หน้าเขียนโพสต์ -->
      @include('write-post')
      <!-- หน้าเขียนโพสต์ -->

      <!-- หน้าโพสต์ -->
      @livewire('like-post')


      <!-- หน้าโพสต์ -->

    </div>
    <!-- right-sidebar -->
    <!-- <div class="right-sidebar"></div> -->
  </div>
</div>

<script>
  // $(".btn-like").click(function() {
  //     alert("The paragraph was clicked.");
  // });

  $('#myModal').on('shown.bs.modal', function() {
    $('#myInput').trigger('focus')
  })

  function update_textlen2(field) {
    var maxlen = 0;
    var fval = field.value;
    var flen = fval.length;
    var tlen = fval.replace(/\n/g, "\r\n").length;
    var dlen = tlen - flen;
    console.log(field.value);
    if (!field.value || !field.value.trim()) {
      // alert('ห้ามใส่ค่าว่าง');
      // console.log ('ห้ามใส่ค่าว่าง');
    }
    // else {
    //     document.getElementById('myclass').className = "btn btn-primary w-100";
    //     var button_class = document.getElementById('myclass').className;
    // }
  }
  update_textlen2(document.getElementById('textarea_post2'));

  function adjust() {
    var style = this.currentStyle || window.getComputedStyle(this);
    var boxSizing = style.boxSizing === 'border-box' ?
      parseInt(style.borderBottomWidth, 10) +
      parseInt(style.borderTopWidth, 10) :
      0;
    this.style.height = '';
    this.style.height = (this.scrollHeight + boxSizing) + 'px';
  };

  var textarea = document.getElementById("textarea_post2");
  if ('onpropertychange' in textarea) { // IE
    textarea.onpropertychange = adjust;
  } else if ('oninput' in textarea) {
    textarea.oninput = adjust;
  }
  setTimeout(adjust.bind(textarea));

  function togglepopup(id) {
    var pop = document.getElementById(id);
    pop.classList.toggle("active");
  }
</script>