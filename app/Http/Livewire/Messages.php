<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Livewire\Component;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Messages extends Component
{

    public $message;
    public $allmessages;
    public $sender;
    public $get_user_to_chat = false;
    public $keydown;

    public $limitPerPage = 15;
    public $users;
    public $users_want_chat = NULL;
    public $last_message;
    // public $arr_count = array();
    public $count_mount = 0;
    public $message_seen;
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

        if (!(empty(Message::count()))) {
            $users1 = DB::table('messages')->select('user_id', 'created_at')->where('receiver_id', Auth::id());
            $users2 = DB::table('messages')->select('receiver_id', 'created_at')->where('user_id', Auth::id());

            $a = $users1->union($users2)->orderByDesc('created_at')->get()->unique('user_id')->pluck('user_id')->toArray();
            $b =  implode(',', $a);
            $user =  User::WhereIn('id', $a)->orderByRaw("FIELD(id,  $b)")->get();
        
            $this->users = $user;
        }


        return view('livewire.messages');
    }
    public function mountdata()
    {
        if (isset($this->sender->id)) {

            $allmessages = Message::where('user_id', Auth::id())->where('receiver_id', $this->sender->id)
                ->orWhere('user_id', $this->sender->id)->where('receiver_id', Auth::id())->orderBy('id', 'desc')
                ->paginate($this->limitPerPage)->items();


            $this->allmessages = $allmessages;

           Message::where('user_id', $this->sender->id)->where('receiver_id', Auth::id())->update(['is_seen' => true]);
          
           
        }
    }
    public function resetForm()
    {
        $this->message = '';
    }

    public function SendMessage()
    {
        $mes =  $this->message;
        $this->resetForm();
        $data = new Message;
        $data->message = $mes;
        $data->user_id = Auth::id();
        $data->receiver_id = $this->sender->id;
        $data->save();
    }

    public function mount(Request $request)

    {
        try {
            $userId =  $request->id;

            if (!empty($userId)) {
                $userId = Crypt::decryptString($userId);
                $user = User::find($userId);
                $this->users_want_chat = $user;
                $this->sender = $user;
                $this->allmessages = Message::where('user_id', Auth::id())->where('receiver_id', $userId)
                    ->orWhere('user_id', $userId)->where('receiver_id', Auth::id())
                    ->orderBy('id', 'desc')->paginate($this->limitPerPage)->items();
                $this->get_user_to_chat = true;
            }
        } catch (\Exception $e) {

            return redirect('/chat');
        }
    }
}
