<?php

namespace App\Http\Livewire;
use App\Models\Message;
use Livewire\Component;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
class Messages extends Component
{
	public $message;
	public $allmessages;
	public $sender;
    public $get_user_to_chat = false;
    public $keydown;

    public $limitPerPage = 15;
    public $users;
    public $users_want_chat =NULL;
    public $last_message;
    // public $arr_count = array();
    public $count_mount = 0;
    // public $post;



    protected $listeners = [
        'load-more' => 'loadMore'
    ];
   
    public function loadMore()
    {
        $this->limitPerPage = $this->limitPerPage + 10;
    }

    public function render()
    {
        $users = array();
        $arr_count = array();
        // $users=User::where('id', Auth::user()->id)->get();
        // $user = User::find(Auth::user()->id);
        
        $msg =  Message::where('user_id', Auth::user()->id)->orWhere('receiver_id', Auth::user()->id)->orderBy('created_at', 'desc')->get() ;
      


      
    
        foreach ($msg as $ms){
           $user = User::Where('id',  $ms->user_id )->orWhere('id', $ms->receiver_id)->get() ;
            // dd($user);

            // $users = $users[0];
            foreach($user as $us){
                if($us->id  != Auth::user()->id){
                    if (!(in_array($us->id, $arr_count))) {

                            array_push($users, $us);

                            array_push($arr_count, $us->id);
                    }
                }
           
             }
         }
        // array_replace($users, [$a[1], $a[0]])
        // $test = Message::orderBy('created_at','desc')->get();
        // dd($test);
        $this->users = $users;
        //  dd($users);
        // foreach($user->messages as $msg){
            
        //     $user_receiv)r=$this->sender;
       
        return view('livewire.messages');
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
        // $this->users_want_chat=NULL;
        // dd($this->sender);
        $li =  Message::where('user_id', Auth::user()->id)->where('receiver_id', $this->sender->id)->orderBy('id', 'desc')->first();
        $p =  User::find(Auth::user()->id);
        // dd($li->id);
        $p->messages()->attach($p->id, ['message_id' => $li->id, 'receiver_id' => $this->sender->id]);
    	$this->resetForm();


    }

    public function mount(Request $request)

    {
        try {
            $userId =  $request->id;
            
            if (!empty($userId)) {
                $userId = Crypt::decryptString($userId);
               
                $arr = array();
                $user = User::find($userId);
                // array_push($this->users, $user);


                $this->users_want_chat = $user;
                $this->sender = $user;
             
                $allmessages = Message::where('user_id', auth()->id())->where('receiver_id', $userId)
                ->orWhere('user_id', $userId)->where('receiver_id', auth()->id())
                ->orderBy('id', 'desc')->paginate($this->limitPerPage)->toArray();
           foreach( $allmessages as $all){
                    dd($allmessages);  
           }
                    
              
               
                // foreach ($allmessages as $messages) {
                //     array_push($arr, $messages);
                // }
               
                // $this->allmessages = $arr;
               
                $this->get_user_to_chat = true;
                // dd($userId);
            }
        } catch (\Exception $e) {
            
            return redirect('/chat');
        }
    }

    // public function GetUserChat(Request $request){
    //     dd($request);
    // }
    // public function getUser($userId)
    // {
    //     $arr = array();
    //    $user=User::find($userId);
    //    $this->sender=$user;
    //     $allmessages= Message::where('user_id',auth()->id())->where('receiver_id',$userId)->orWhere('user_id',$userId)->where('receiver_id',auth()->id())->orderBy('id','desc')->paginate($this->limitPerPage);
       
    //    foreach($allmessages as $messages){
    //     array_push($arr,$messages);
    //    }
    // // dd($all);
    //    $this->allmessages = $arr;
    //    $this->get_user_to_chat = true;
    // //    dd($userId);
       
    // }

}
