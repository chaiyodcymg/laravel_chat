<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;



class commentController extends Controller
{
    public function store(Request $request)
    {
        // $comment = new Comment;
        // $comment->write_comment = $request->get('comment_body');
        // $comment->user()->associate($request->user());
        // $post = Post::find($request->get('post_id'));
        // $post->comments()->save($comment);
        // return back();
        // return redirect('/');
    }
}
