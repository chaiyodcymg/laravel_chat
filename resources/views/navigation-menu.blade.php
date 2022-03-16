 <nav x-data="{ open: false }" class="navbar navbar-expand navbar-light bg-white ">
     <!-- Primary Navigation Menu -->
     <div class="container navbar-container">
         <!-- Logo -->
         <a class="navbar-brand" href="{{ route('feed') }}"><img class="logo" src="{{asset('img/tomatoe.png')}}" alt="logo tometalk"></a>
         <div class="normal-search">@livewire('search-user')</div>



         <script>
             //  const icon = document.querySelector('.icon');
             //  const search = document.querySelector('.search');
             //  icon.onclick = function() {
             //      search.classList.toggle('open')
             //  }

             //  $(".icon").click(function() {
             //      $(".nav-icon").toggleClass("hide");

             //  });



             //  $("#search").keyup(function() {
             //      $("#box-search").toggleClass("show-box");
             //      var value = $(this).val().toLowerCase();
             //      $("#box-search #box-name").filter(function() {
             //          var search = $(this).text().toLowerCase();
             //          if (search.indexOf(value) > -1) {
             //              $(this).show();
             //          } else {
             //              $(this).hide();
             //          }
             //      });
             //  });
             //  
         </script>

         <!-- Navigation Links -->
         <ul class="nav-icon">
             <!-- <li class="nav-item home"></li> -->
             <li class="nav-item">
                 <a class="notifi-all nav-link {{(request()->routeIs('feed')) ? 'active' : '' }}" href="{{ route('feed') }}" aria-current="page">
                     <!-- <div class=""> -->
                     <!-- <i class="fa-solid fa-house" ></i> -->
                     <svg class="svg-house" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                         <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                         <path d="M575.8 255.5C575.8 273.5 560.8 287.6 543.8 287.6H511.8L512.5 447.7C512.5 450.5 512.3 453.1 512 455.8V472C512 494.1 494.1 512 472 512H456C454.9 512 453.8 511.1 452.7 511.9C451.3 511.1 449.9 512 448.5 512H392C369.9 512 352 494.1 352 472V384C352 366.3 337.7 352 320 352H256C238.3 352 224 366.3 224 384V472C224 494.1 206.1 512 184 512H128.1C126.6 512 125.1 511.9 123.6 511.8C122.4 511.9 121.2 512 120 512H104C81.91 512 64 494.1 64 472V360C64 359.1 64.03 358.1 64.09 357.2V287.6H32.05C14.02 287.6 0 273.5 0 255.5C0 246.5 3.004 238.5 10.01 231.5L266.4 8.016C273.4 1.002 281.4 0 288.4 0C295.4 0 303.4 2.004 309.5 7.014L564.8 231.5C572.8 238.5 576.9 246.5 575.8 255.5L575.8 255.5z" />
                     </svg>
                     <!-- </div> -->
                 </a>

             </li>
             <li class="nav-item chat">
                 <a class="notifi-all nav-link {{(request()->routeIs('chat')) ? 'active' : '' }}" href="{{ route('chat') }}">
                     <div class="icon-nav ">
                         <!-- <i class="fa-solid fa-message "></i> -->
                         <svg class="svg-message" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                             <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                             <path d="M511.1 63.1v287.1c0 35.25-28.75 63.1-64 63.1h-144l-124.9 93.68c-7.875 5.75-19.12 .0497-19.12-9.7v-83.98h-96c-35.25 0-64-28.75-64-63.1V63.1c0-35.25 28.75-63.1 64-63.1h384C483.2 0 511.1 28.75 511.1 63.1z" />
                         </svg>
                     </div>
                     <span class="notifi ">1</span>
                 </a>
             </li>

             @livewire('notifi')

         </ul>



         <div class=" sm:flex sm:items-center">
             <!-- Teams Dropdown -->
             @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
             <div class="ml-3 relative">
                 <x-jet-dropdown align="right" width="60">
                     <x-slot name="trigger">
                         <span class="inline-flex rounded-md">
                             <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                 {{ Auth::user()->currentTeam->name }}

                                 <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                     <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                 </svg>
                             </button>
                         </span>
                     </x-slot>

                     <x-slot name="content">
                         <div class="w-60">
                             <!-- Team Management -->
                             <div class="block px-4 py-2 text-xs text-gray-400">
                                 {{ __('Manage Team') }}
                             </div>

                             <!-- Team Settings -->
                             <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                 {{ __('Team Settings') }}
                             </x-jet-dropdown-link>

                             @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                             <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                 {{ __('Create New Team') }}
                             </x-jet-dropdown-link>
                             @endcan

                             <div class="border-t border-gray-100"></div>

                             <!-- Team Switcher -->
                             <div class="block px-4 py-2 text-xs text-gray-400">
                                 {{ __('Switch Teams') }}
                             </div>

                             @foreach (Auth::user()->allTeams() as $team)
                             <x-jet-switchable-team :team="$team" />
                             @endforeach
                         </div>
                     </x-slot>
                 </x-jet-dropdown>
             </div>
             @endif

             <!-- Settings Dropdown -->
             <!-- ยังไม่ได้แก้ไข -->
             <div class="ml-3 test">
                 <x-jet-dropdown align="right" width="48">
                     <x-slot name="trigger">
                         @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                         <div class="usertab nav-profile-photo">
                             <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition" id="hide-user">
                                 <img class="h-8 w-8 rounded-full object-cover img-profile" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                             </button>
                             <div class="ml-2 d-flex justify-content-center align-items-center" id="test">


                                 <span class="nameshow">{{ Auth::user()->name }}</span>


                             </div>
                         </div>
                         @else
                         <span class="inline-flex rounded-md">
                             <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ">
                                 {{ Auth::user()->name }}

                                 <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                     <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                 </svg>
                             </button>
                         </span>
                         @endif
                     </x-slot>

                     <x-slot name="content">
                         <!-- Account Management -->
                         <div class="block px-4 py-2 text-xs text-gray-400">
                             {{ __('Manage Account') }}
                         </div>

                         <x-jet-dropdown-link href="{{ route('profile') }}">
                             <div class="d-flex">
                                 <svg class="icon-setting mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                     <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                     <path d="M272 304h-96C78.8 304 0 382.8 0 480c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32C448 382.8 369.2 304 272 304zM48.99 464C56.89 400.9 110.8 352 176 352h96c65.16 0 119.1 48.95 127 112H48.99zM224 256c70.69 0 128-57.31 128-128c0-70.69-57.31-128-128-128S96 57.31 96 128C96 198.7 153.3 256 224 256zM224 48c44.11 0 80 35.89 80 80c0 44.11-35.89 80-80 80S144 172.1 144 128C144 83.89 179.9 48 224 48z" />
                                 </svg>
                                 {{ __('Profile') }}
                             </div>
                         </x-jet-dropdown-link>
                         <x-jet-dropdown-link href="{{ route('profile.show') }}">
                             <div class="d-flex">
                                 <svg class="icon-setting mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                     <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                     <path d="M286.3 155.1C287.4 161.9 288 168.9 288 175.1C288 183.1 287.4 190.1 286.3 196.9L308.5 216.7C315.5 223 318.4 232.1 314.7 241.7C312.4 246.1 309.9 252.2 307.1 257.2L304 262.6C300.1 267.6 297.7 272.4 294.2 277.1C288.5 284.7 278.5 287.2 269.5 284.2L241.2 274.9C230.5 283.8 218.3 290.9 205 295.9L198.1 324.9C197 334.2 189.8 341.6 180.4 342.8C173.7 343.6 166.9 344 160 344C153.1 344 146.3 343.6 139.6 342.8C130.2 341.6 122.1 334.2 121 324.9L114.1 295.9C101.7 290.9 89.5 283.8 78.75 274.9L50.53 284.2C41.54 287.2 31.52 284.7 25.82 277.1C22.28 272.4 18.98 267.5 15.94 262.5L12.92 257.2C10.13 252.2 7.592 247 5.324 241.7C1.62 232.1 4.458 223 11.52 216.7L33.7 196.9C32.58 190.1 31.1 183.1 31.1 175.1C31.1 168.9 32.58 161.9 33.7 155.1L11.52 135.3C4.458 128.1 1.62 119 5.324 110.3C7.592 104.1 10.13 99.79 12.91 94.76L15.95 89.51C18.98 84.46 22.28 79.58 25.82 74.89C31.52 67.34 41.54 64.83 50.53 67.79L78.75 77.09C89.5 68.25 101.7 61.13 114.1 56.15L121 27.08C122.1 17.8 130.2 10.37 139.6 9.231C146.3 8.418 153.1 8 160 8C166.9 8 173.7 8.418 180.4 9.23C189.8 10.37 197 17.8 198.1 27.08L205 56.15C218.3 61.13 230.5 68.25 241.2 77.09L269.5 67.79C278.5 64.83 288.5 67.34 294.2 74.89C297.7 79.56 300.1 84.42 304 89.44L307.1 94.83C309.9 99.84 312.4 105 314.7 110.3C318.4 119 315.5 128.1 308.5 135.3L286.3 155.1zM160 127.1C133.5 127.1 112 149.5 112 175.1C112 202.5 133.5 223.1 160 223.1C186.5 223.1 208 202.5 208 175.1C208 149.5 186.5 127.1 160 127.1zM484.9 478.3C478.1 479.4 471.1 480 464 480C456.9 480 449.9 479.4 443.1 478.3L423.3 500.5C416.1 507.5 407 510.4 398.3 506.7C393 504.4 387.8 501.9 382.8 499.1L377.4 496C372.4 492.1 367.6 489.7 362.9 486.2C355.3 480.5 352.8 470.5 355.8 461.5L365.1 433.2C356.2 422.5 349.1 410.3 344.1 397L315.1 390.1C305.8 389 298.4 381.8 297.2 372.4C296.4 365.7 296 358.9 296 352C296 345.1 296.4 338.3 297.2 331.6C298.4 322.2 305.8 314.1 315.1 313L344.1 306.1C349.1 293.7 356.2 281.5 365.1 270.8L355.8 242.5C352.8 233.5 355.3 223.5 362.9 217.8C367.6 214.3 372.5 210.1 377.5 207.9L382.8 204.9C387.8 202.1 392.1 199.6 398.3 197.3C407 193.6 416.1 196.5 423.3 203.5L443.1 225.7C449.9 224.6 456.9 224 464 224C471.1 224 478.1 224.6 484.9 225.7L504.7 203.5C511 196.5 520.1 193.6 529.7 197.3C535 199.6 540.2 202.1 545.2 204.9L550.5 207.9C555.5 210.1 560.4 214.3 565.1 217.8C572.7 223.5 575.2 233.5 572.2 242.5L562.9 270.8C571.8 281.5 578.9 293.7 583.9 306.1L612.9 313C622.2 314.1 629.6 322.2 630.8 331.6C631.6 338.3 632 345.1 632 352C632 358.9 631.6 365.7 630.8 372.4C629.6 381.8 622.2 389 612.9 390.1L583.9 397C578.9 410.3 571.8 422.5 562.9 433.2L572.2 461.5C575.2 470.5 572.7 480.5 565.1 486.2C560.4 489.7 555.6 492.1 550.6 496L545.2 499.1C540.2 501.9 534.1 504.4 529.7 506.7C520.1 510.4 511 507.5 504.7 500.5L484.9 478.3zM512 352C512 325.5 490.5 304 464 304C437.5 304 416 325.5 416 352C416 378.5 437.5 400 464 400C490.5 400 512 378.5 512 352z" />
                                 </svg>
                                 {{ __('Setting') }}
                             </div>
                         </x-jet-dropdown-link>
                         @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                         <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                             {{ __('API Tokens') }}
                         </x-jet-dropdown-link>
                         @endif

                         <div class="border-t border-gray-100"></div>

                         <!-- Authentication -->
                         <form method="POST" action="{{ route('logout') }}">
                             @csrf

                             <x-jet-dropdown-link class="logout" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                 <div class="d-flex">
                                     <svg class="icon-logout mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                         <!--! Font Awesome Pro 6.0.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                                         <path d="M160 416H96c-17.67 0-32-14.33-32-32V128c0-17.67 14.33-32 32-32h64c17.67 0 32-14.33 32-32S177.7 32 160 32H96C42.98 32 0 74.98 0 128v256c0 53.02 42.98 96 96 96h64c17.67 0 32-14.33 32-32S177.7 416 160 416zM502.6 233.4l-128-128c-12.51-12.51-32.76-12.49-45.25 0c-12.5 12.5-12.5 32.75 0 45.25L402.8 224H192C174.3 224 160 238.3 160 256s14.31 32 32 32h210.8l-73.38 73.38c-12.5 12.5-12.5 32.75 0 45.25s32.75 12.5 45.25 0l128-128C515.1 266.1 515.1 245.9 502.6 233.4z" />
                                     </svg>
                                     {{ __('Log Out') }}
                                 </div>
                             </x-jet-dropdown-link>
                         </form>
                     </x-slot>
                 </x-jet-dropdown>
             </div>
         </div>
     </div>



     <!-- Responsive Navigation Menu ยังไม่ได้แก้ไข-->
     <div :class=" {'block': open, 'hidden': ! open} " class="hidden md:hidden respon-menu">
         <!-- id="setting-menu-login" -->



         <!-- Responsive Settings Options -->
         <div class="pt-4 pb-1 " id="test-setting">
             <div class="flex items-center px-4">
                 @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                 <div class="shrink-0 mr-3">
                     <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                 </div>
                 @endif

                 <div>
                     <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                     <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                 </div>
             </div>

             <div class="mt-3 space-y-1 border-t border-gray-200 respon-option">
                 <!-- Account Management -->
                 <ul class="respon-dropdown">
                     <li><a class="dropdown-item" href="{{ route('profile') }}">{{ __('Profile') }}</a></li>
                     <li><a class="dropdown-item" href="{{ route('profile.show') }}">{{ __('Setting') }}</a></li>
                 </ul>


                 @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                 <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                     {{ __('API Tokens') }}
                 </x-jet-responsive-nav-link>
                 @endif

                 <!-- Authentication -->
                 <form method="POST" action="{{ route('logout') }}">
                     @csrf

                     <ul class="respon-dropdown">

                         <li><a class="dropdown-item logout" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    this.closest('form').submit();">{{ __('Log Out') }}</a></li>
                     </ul>


                 </form>

                 <!-- Team Management
                 @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                 <div class="border-t border-gray-200"></div>

                 <div class="block px-4 py-2 text-xs text-gray-400">
                     {{ __('Manage Team') }}
                 </div> -->

                 <!-- Team Settings -->
                 <!-- <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                     {{ __('Team Settings') }}
                 </x-jet-responsive-nav-link>

                 @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                 <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                     {{ __('Create New Team') }}
                 </x-jet-responsive-nav-link>
                 @endcan

                 <div class="border-t border-gray-200"></div> -->

                 <!-- Team Switcher -->
                 <!-- <div class="block px-4 py-2 text-xs text-gray-400">
                     {{ __('Switch Teams') }}
                 </div> -->

                 <!-- @foreach (Auth::user()->allTeams() as $team)
                 <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                 @endforeach
                 @endif -->
             </div>
         </div>
     </div>
 </nav>
 <div class="all-search">
     @livewire('search-user')
 </div>

<div class="space"></div>


 