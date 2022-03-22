<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

class WritePostController extends Controller
{
    //
    public function submit_post(Request $request){

        // dd($request->whitten_post);
    $post = new post;
    $post->whitten_post=$request->whitten_post;
    $post->user_id=Auth::user()->id;
    $post->save();
    return redirect()->back();
    }
}
