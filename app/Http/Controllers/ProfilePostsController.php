<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class ProfilePostsController extends Controller
{
    //
    
    public function profile_post(){

       
           $posts= Post::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
   
           return view('profile',compact('posts'));
       }
}
