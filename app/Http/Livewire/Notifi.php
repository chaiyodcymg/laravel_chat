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
    public $noti;
    public $list_notis;
    public $count = 0 ;
    public function render()
    {
        $noti= Notification::where('receiver_id', Auth::user()->id)->where('read', false)->get();
        $list_noti = Notification::where('receiver_id', Auth::user()->id)->get();
        $this->noti = $noti;
        $this->list_notis = $list_noti;
        //    dd($posts[8]);
        return view('livewire.notifi');
    }
    public function read_noti()
    {
        // 
        $noti =  Notification::where('receiver_id', Auth::user()->id);
        // dd($noti);

        $this->count++;
        if ($this->count == 1) {
            $noti->update(['read' => true]);
            $this->count = 0;
        }
        else if($this->count == 2){
            $this->count = 0;
            dd($this->count);
            
        }
      
        // if($this->count == 0){
        //     $noti->update(['read' => true]);
        // }else{

        // }

    }
    public function mount_data(){
        $noti =  Notification::where('receiver_id', Auth::user()->id);
        // dd($noti);
        $noti->update(['read' => true]);
    }
}
