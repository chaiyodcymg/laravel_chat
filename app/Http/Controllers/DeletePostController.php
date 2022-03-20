<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Comment;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class DeletePostController extends Controller
{
    public function delete(Request $request)
    {
        try {
        $id = Crypt::decryptString($request->id);
        $wherelike = Like::where('post_id',$id)->get();
        $wherenoti = Notification::where('post_id',$id)->get();
        $wherecomment = Comment::where('post_id',$id)->get();

        Comment::destroy($wherecomment);
        Notification::destroy($wherenoti);
        Like::destroy($wherelike);  
        Post::destroy($id);
        return redirect('/');
        } catch (\Exception $e) {

            return back();
        }
    }
}
