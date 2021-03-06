<x-app-layout>

</x-app-layout>
<div class="container fluid">
  @livewire('follow',[ 'user_id' => Auth::user()->id])

  @include('write-post')
  <!---- post ---->

  @livewire('like-post',[ 'other_user' => Auth::user()->id])


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
      document.getElementById('myclass').className = "btn btn-primary w-100";
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
</script>