<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container">
 
    <div class="card" style="width:400px">
        <img class="card-img-top" src="https://cdn.pixabay.com/photo/2021/10/13/11/29/girl-6706267_960_720.jpg" alt="Card image" style="width:100%">
        <div class="card-body">
        <h4 class="card-title">John Doe</h4>
        <p class="card-text">Some example text some example text. John Doe is an architect and engineer</p>
        <a href="#" class="btn btn-primary">See Profile</a>
        </div>
    </div>
    <br>


   </div>
</x-app-layout>
