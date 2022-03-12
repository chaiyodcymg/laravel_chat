<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use APP\Models\Comment AS com;

class Comment extends Component
{
    public function render()
    {

        return view('livewire.comment');
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
>>>>>>> 05e9faecfbc2b40dd7a6358eb3b1cceafe458d32

        $commenttest =  DB::table('Comment')
            ->join('users', 'users.id', '=', 'comments.user_id')
            ->join('posts', 'posts.id', '=', 'comments.post_id')
            ->select('users.*')
            ->where('comment.id', $this->user_id)->get();
        
<<<<<<< HEAD
=======
>>>>>>> 9b5b432490bbe39f831b7b169a4186c750882d84
>>>>>>> 05e9faecfbc2b40dd7a6358eb3b1cceafe458d32
    }
    public function comment()
    {
        dd('เข้า');
        // $Comment = new Comments;
        // $Comment->posts->user_id = Auth::user()->id;
        // $Comment->post_id = $this->post_id;
        // $Comment->write_comment = 
        // $Comment->save();
    }
    
    // public function comment_post(Request $request)
    // {
    //     $Comment = new Comments;
    //     $Comment->posts->user_id = Auth::user()->id;
    //     $Comment->post_id = $this->post_id;
    //     $Comment->write_comment = $request->write_comment;
    //     $Comment->save();
    //     return redirect("/");
    // }
}
