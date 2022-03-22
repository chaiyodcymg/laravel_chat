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
        return view('livewire.search-user');
    }

    public function updatedSearch()
    {

        if (trim($this->search) != "") {
            $this->users =  User::where('name', 'LIKE', $this->search . "%")
                ->orWhere('name', 'LIKE', "%" . $this->search . "%")->get();
        }
    }

    public function mount()
    {
        $this->search = "";
        $this->users = [];
        
    }
}
