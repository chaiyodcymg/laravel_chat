   <div>

       <div class="expand relative">
           <div class="search">
               <div class="icon fa" aria-hidden="false"></div>
               <div class="inputspace">
                   <input autocomplete="off" type="text" placeholder="ค้นหา..." id="search" wire:model="search">
               </div>
           </div>
       </div>

     
      
           <div id="box-search" class="absolute z-50 w-48 rounded-md shadow-lg origin-top-left left-2" style="display: block;">

               @if(!empty($search))
               @if(!empty($users))

               @foreach($users as $user)

               @if($user->id != Auth::user()->id)
               <a href="{{route('otheruser', ['user_id' => Crypt::encryptString($user->id)])}}" class="menu-sidebar" id="box-name">
                   <img class="card-img-profile" src="{{$user->profile_photo_url}}" alt="#">
                   <div class="card-body-menu">

                       <p class="card-title-menu">{{$user->name}}</p>
                   </div>
               </a>
               @endif

               @endforeach


               @endif
               @else

               @endif
           </div>
   </div>

   <script>
       const icon = document.querySelector('.icon');
       const search = document.querySelector('.all-search');
       const searchclick = document.querySelector('.search');
       icon.onclick = function() {
           search.classList.toggle('open')
           icon.classList.toggle('hide-icon')
           icon.classList.toggle('back')
           searchclick.classList.toggle('type')


       }

       $(".icon").click(function() {
           $(".nav-icon").toggleClass("hide");
           //   $(".wrapsearch").classList.toggle('open')

       });
   </script>