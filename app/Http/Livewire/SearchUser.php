<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
class SearchUser extends Component
{
    public $search;
    public $users;
    public function render()
    {
        // $users ="";
        if(!empty($this->search)){

            // dd($this->search);

            $this->users =  User::where('name', 'LIKE', $this->search."%")->get();
            // dd($search_user);

        
            // dd($users);
        }
       
        // else{
        //     $this->users = User::all();
        // }
     
       
        return view('livewire.search-user');
    }
    public function mount(){
        $this->search = "";
         $this->users =[];
    }
    // public function Search_User(){
        // $search_user =  "หิว";
        // $this->users =  User::all();
        // $this->users=  User::where('name', 'LIKE', "%". $this->search."%")->get();
        // dd($this->users);
    // }
}
