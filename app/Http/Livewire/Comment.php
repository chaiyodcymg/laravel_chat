<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use APP\Models\Comments;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Comment extends Component
{
    public $comments;

    public function render()
    {
        $comments = Comment::orderBy('created_at', 'desc')->get();
        if (isset($this->other_user)) {
            $comments = Comment::where('user_id', $this->other_user)->orderBy('created_at', 'desc')->get();
        }
        $this->comments = $comments;
        return view('livewire.comment');

        $commenttest =  DB::table('Comment')
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->join('posts', 'posts.id', '=', 'comments.post_id')
            ->select('users.*')
            ->where('comment.id', $this->user_id)->get();
        
    }

    public function comment()
    {
        $Comment = new Comment;
        $Comment->user_id = Auth::user()->id;
        $Comment->id = $this->user_id;
        $Comment->save();
    }
    // public function store(Request $request)
    // {
        // $comment = new Comment;
        // $comment->write_comment = $request->get('comment_body');
        // $comment->user()->associate($request->user());
        // $post = Post::find($request->get('post_id'));
        // $post->comments()->save($comment);
        // return back();
        // return redirect('/');
    // }
}
