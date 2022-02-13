<?php

namespace App\Http\Livewire;
use App\Models\Message;
use Livewire\Component;
use App\Models\User;
class Messages extends Component
{
	public $message;
	public $allmessages;
	public $sender;
    public $get_user_to_chat = false;
    public $keydown;
    public $image  = 'image/user.png';

    public $limitPerPage = 15;
    protected $listeners = [
        'load-more' => 'loadMore'
    ];
   
    public function loadMore()
    {
        $this->limitPerPage = $this->limitPerPage + 10;
    }
    public function render()
    {
    	$users=User::all();
    	$sender=$this->sender;
    
        return view('livewire.messages',compact('users','sender'));
    }
    public function mountdata()
    {
        if(isset($this->sender->id))
        {
            $arr = array();
                  $allmessages=Message::where('user_id',auth()->id())->where('receiver_id',$this->sender->id)->orWhere('user_id',$this->sender->id)->where('receiver_id',auth()->id())->orderBy('id','desc')->paginate($this->limitPerPage);
       
                foreach($allmessages as $messages){
                    array_push($arr,$messages);
                }
                $this->allmessages = $arr ;

               $not_seen= Message::where('user_id',$this->sender->id)->where('receiver_id',auth()->id());
               $not_seen->update(['is_seen'=> true]);
        }

    }
    public function resetForm()
    {
    	$this->message='';
    }

    public function SendMessage()
    {
    	$data=new Message;
    	$data->message=$this->message;
    	$data->user_id=auth()->id();
    	$data->receiver_id=$this->sender->id;
    	$data->save();

    	$this->resetForm();


    }
    public function getUser($userId)
    {
        $arr = array();
       $user=User::find($userId);
       $this->sender=$user;
       $allmessages=Message::where('user_id',auth()->id())->where('receiver_id',$userId)->orWhere('user_id',$userId)->where('receiver_id',auth()->id())->orderBy('id','desc')->paginate($this->limitPerPage);
       
       foreach($allmessages as $messages){
        array_push($arr,$messages);
       }
       $this->allmessages = $arr ;
       $this->get_user_to_chat = true;
       
    }

}
