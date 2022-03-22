<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Following;
use App\Models\Follower;
use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FeedNewsController extends Controller
{



    public function index()
    {

        // $users=User::all();
        // $posts= Post::orderBy('created_at','desc')->get();

        $followings =  Following::where('user_id', Auth::user()->id)->get();


        return view('feed_news',compact('followings'));
    }
    //     public function index()
    // {
    //     $followings =  DB::table('follows')
    //         ->join('users', 'users.id', '=', 'follows.user_id')
    //         ->select('users.name')
    //         ->where('follows.user_id', Auth::user()->id)->get();
    //     return view('list-name-follow', compact('followings'));
    // }

}
