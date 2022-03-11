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

        $users =  User::all();


        // dd($users);
        // return view('list-name-follow', compact('followings'));
        //   $post =  PostLike::where('post_id',1)->get();
        // $users = User::all();

        // $l =  PostLike::find(2);
        //   var_dump($post->postlike);
        // $count_like = Post::
        // foreach($posts as $post){
        // $posts = Post::with(['posts', 'postlike'])->get();
        // $PostLike = PostLike::first();
        // dd($posts);
        // }
        return view('feed_news',compact('users'));
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
