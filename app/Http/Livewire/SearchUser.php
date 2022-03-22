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
    
        if(!empty($this->search)){

            $this->users =  User::where('name', 'LIKE', $this->search."%")->get();

        }
   
      
        return view('livewire.search-user');
    }

    public function mount(){
        $this->search = "";
         $this->users =[];
    }

}
