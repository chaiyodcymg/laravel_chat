<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Following ;
use App\Models\Follower;
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
        return view('livewire.follow');
    }
    public function following()
    {
        $Following = new Following;
        $Following->user_id = Auth::user()->id;
        $Following->following_id = $this->user_id;
        $Following->save();

        $Follower = new Follower;
        $Follower->user_id = $this->user_id;
        $Follower->follower_id = Auth::user()->id;
        $Follower->save();
    }
}
