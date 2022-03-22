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
      @livewire('feed-news')


      <!-- หน้าโพสต์ -->

    </div>
    <!-- right-sidebar -->
    <!-- <div class="right-sidebar"></div> -->
  </div>
</div>

