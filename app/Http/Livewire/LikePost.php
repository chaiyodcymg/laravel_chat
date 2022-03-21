<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Carbon;
// use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Collection;
use App\Models\Following;
use App\Models\Follower;
use Illuminate\Support\Arr;
use App\Models\Comment;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;

class LikePost extends Component
{
    public $LikePost;
    public $UserLikePost;
    public $fillColor;
    public $checklike;
    public $posts;
    public $Post_Id;
    public $count_post_like;
    public $other_user;
    public $showfollowpost;
    public $text_comment = array();
    public $postshow;


    public function render()
    {

        $follows =  Following::where('user_id', Auth::id())->pluck('following_id')->toArray();

        $posts =  Post::where('user_id', Auth::id())->union(Post::whereIn('user_id', $follows))->orderBy('created_at', 'desc')->get();



        if (isset($this->other_user)) {
            $posts = Post::where('user_id', $this->other_user)->orderBy('created_at', 'desc')->get();
            $this->posts = $posts;
        } else {
            $this->posts = $posts;
        }

        return view('livewire.like-post');
    }

    public function UserLikePost($post)
    {

        try {

            $post =  (int) Crypt::decryptString($post);
            $result =  Like::withTrashed()->where('user_id', Auth::user()->id)->where('post_id', $post)->get();



            if ($result->isEmpty()) {
                $Like = new Like;
                $Like->user_id = Auth::user()->id;
                $Like->post_id = $post;
                $Like->save();

                $p =  Post::find($post);


                if ($p->user->id != Auth::user()->id) {

                    $notifi  = new Notification;
                    $notifi->sender_id = Auth::user()->id;
                    $notifi->receiver_id = $p->user->id;
                    $notifi->post_id = $post;
                    $notifi->message_data = "กดไลค์โพสต์ของคุณ";
                    $notifi->save();
                }
            } else {

                $re =   Like::onlyTrashed()->where('id', $result[0]->id)->get();
                if ($re->isEmpty()) {
                    Like::destroy($result[0]->id);
                } else {
                    Like::withTrashed()->where('id', $result[0]->id)->restore();
                }
            }
        } catch (\Exception $e) {

            return back();
        }
    }
    public function comment($post)
    {

        try {
            $posts =    Post::find($post);
            // dd(gettype( $post));
            // dd($this->text_comment);
            if (!empty($this->text_comment)) {
                if (trim($this->text_comment[$post]) != "") {
                    $comm  = $this->text_comment[$post];
                    $this->text_comment[$post] = "";
                    // $this->text_comment = array();

                    $Comment = new Comment;
                    $Comment->user_id = Auth::user()->id;
                    $Comment->post_id = $post;
                    $Comment->write_comment = $comm;
                    $Comment->save();
                }
            }
            if ($posts->user->id != Auth::user()->id) {
                $notifi  = new Notification;
                $notifi->sender_id = Auth::user()->id;
                $notifi->receiver_id = $posts->user->id;
                $notifi->post_id = $post;

                $notifi->message_data = "คอมเมนต์โพสต์ของคุณ";
                $notifi->save();
            }
        } catch (\Exception $e) {

        
        }
    }

    public function mount(Request $request)
    {
        if (!empty($request->id)) {

            $post_id =   Crypt::decryptString($request->id);
            $this->postshow = Post::find($post_id);
        }
    }
}
