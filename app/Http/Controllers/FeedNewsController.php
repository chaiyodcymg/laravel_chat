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
        $followings =  Following::where('user_id', Auth::user()->id)->get();


        return view('feed_news',compact('followings'));
    }


}
