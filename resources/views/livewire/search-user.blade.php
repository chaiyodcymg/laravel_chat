   <div>

       <div class="expand relative">
           <div class="search">
               <label for="search" class="icon fa" aria-hidden="false"></label>
               <div class="inputspace">
                   <input autocomplete="off" type="text" placeholder="Search..." id="search" wire:model="search">
               </div>
           </div>
       </div>



       <div id="box-search" class="absolute z-50 w-48 rounded-md shadow-lg " style="display: block;">

           @if(!empty($search))

           <div class="list-group ">
               @foreach($users as $user)

               @if($user->id != Auth::user()->id)

               <a href="{{route('otheruser', ['user_id' => Crypt::encryptString($user->id)])}}" class="menu-sidebar" id="box-name">
                   <img class="card-img-profile" src="{{$user->profile_photo_url}}" alt="#">

                   <p class="">{{$user->name}}</p>

               </a>
               @endif

               @endforeach



               @else

               @endif
           </div>
       </div>
   </div>