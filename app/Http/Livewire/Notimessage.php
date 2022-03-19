<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Notimessage extends Component
{
    public $messages;
    public function render()
    {
        $message = DB::table('users')->join('messages', 'messages.receiver_id', '=' ,'users.id' )->select('messages.user_id')->where('is_seen','0')->where('users.id',Auth::id())->distinct()->get();
$this->messages = count($message);

        return view('livewire.notimessage');
    }
}
