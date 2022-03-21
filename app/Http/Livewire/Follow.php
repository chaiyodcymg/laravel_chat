<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Following ;
use App\Models\Follower;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Follow extends Component
{
    public $user_id;
    public $users;
    public $count_folllower;
    public $count_folllowing;
    

    public function render()
    {
        // dd($this->user_id);
        $user_target = User::where('id', $this->user_id)->get();
 
        // // $follow =  Follow::where('follow_id', $this->user_id)->get();
        // $follower =  DB::table('follows')
        //     ->join('users', 'users.id', '=', 'follows.user_id')
        //     ->select('users.*')
        //     ->where('follows.follow_id', $this->user_id)->get();
        // $following =  DB::table('follows')
        //     ->join( 'users','users.id','=','follows.user_id')
        //     ->select('users.*')
        //     ->where('follows.user_id', $this->user_id)->get();

        // $this->count_folllower = count($follower);
        // $this->count_folllowing = count($following);
        $this->users = $user_target;
        // dd($user_target[0]->followers);
        return view('livewire.follow');
    }
    public function following()
    {
      
        $result_following =  Following::withTrashed()->where('user_id', Auth::user()->id)->where('following_id', $this->user_id)->get();
        $result_follower =  Follower::withTrashed()->where('user_id', $this->user_id)->where('follower_id', Auth::user()->id)->get();
        if ($result_following->isEmpty() && $result_follower->isEmpty()) {
       
            $Following = new Following;
            $Following->user_id = Auth::user()->id;
            $Following->following_id = $this->user_id;
            $Following->save();
        
            $Follower = new Follower;
            $Follower->user_id = $this->user_id;
            $Follower->follower_id = Auth::user()->id;
            $Follower->save();

            $notifi  = new Notification;
            $notifi->sender_id = Auth::user()->id;
            $notifi->receiver_id = $Follower->user->id;
            $notifi->message_data = "Followed you";
            $notifi->save();
           
        }else{

            $result_1 =   Following::onlyTrashed()->where('user_id', $result_following[0]->user_id)->where('following_id', $result_following[0]->following_id)->get();
            $result_2 =   Follower::onlyTrashed()->where('user_id',$result_follower[0]->follower_id)->where('follower_id', $result_follower[0]->user_id)->get();
         
            if($result_1->isEmpty() && $result_2->isEmpty()){
                Following::destroy($result_following[0]->id);
                Follower::destroy($result_follower[0]->id);
            }else{
                
                Following::withTrashed()->where('id', $result_following[0]->id)->restore();
                Follower::withTrashed()->where('id', $result_follower[0]->id)->restore();
               
            }
        
        }
    }
}
