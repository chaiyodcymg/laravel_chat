<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\Comment;
use App\Models\Notification;
class Notifi extends Component
{
    public $open;
    public $noti;
    public $list_notis;
    public $count = false ;
    public $show_noti = false;

    protected $listeners = ['read_noti'];

    public function render()
    {
        
        $noti= Notification::where('receiver_id', Auth::user()->id)->where('read', false)->get();
        $list_noti = Notification::where('receiver_id', Auth::user()->id)->where('sender_id', "!=", Auth::user()->id)->orderBy('id', 'desc')->get();
        $this->noti = $noti;
        $this->list_notis = $list_noti;
        if($this->show_noti == true){
            $noti =  Notification::where('receiver_id', Auth::user()->id);
            $noti->update(['read' => true]);
        }
 
        return view('livewire.notifi');
    }
    public function read_noti()
    {

        $this->show_noti = !$this->show_noti;
        if ($this->show_noti == true) {
            $noti =  Notification::where('receiver_id', Auth::user()->id);
            $noti->update(['read' => true]);
            $this->open = 'เปิด';
           
        }

    }

}
