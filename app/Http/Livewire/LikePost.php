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
    public $text_comment = [];
    public $postshow;


    public function render()
    {



        $arr = array();
        $posts_arr = array();
        $follows =  Following::where('user_id', Auth::user()->id)->get();
        // dd($follows[0]->user);
        $posts_auth =   Post::where('user_id', Auth::user()->id)->get();
        // dd($posts_auth);
        foreach ($posts_auth as $posts_aut) {
            array_push($posts_arr, $posts_aut);
        }
        foreach ($follows as $follow) {
            array_push($arr, $follow->user->posts);
        }

        foreach ($arr as $ar) {

            foreach ($ar as $a) {

                array_push($posts_arr, $a);
            }
        }
        // 
        // $posts_arr = collect($posts_arr)->sort() ;
        // dd(strtotime(
        //     $posts_arr[0]->created_at
        // ));


        $price = array_column($posts_arr, 'created_at');
        array_multisort($price, SORT_DESC, $posts_arr);


        //  

        if (isset($this->other_user)) {
            $posts = Post::where('user_id', $this->other_user)->orderBy('id', 'desc')->get();
            $this->posts = $posts;
        } else {
            $this->posts = $posts_arr;
        }

        // $posts = Post::find($this->LikePost);
        // $this->count_post_like = count($posts->postlikes);
        // $this->Post_Id = $posts->postlikes;
        return view('livewire.like-post');
    }
    public function count_like_post()
    {
    }

    // protected $listeners = ['like'=>'UserLikePost'];

    public function UserLikePost($post)
    {

        try {

            $post =  (int) Crypt::decryptString($post);
            $result =  Like::withTrashed()->where('user_id', Auth::user()->id)->where('post_id', $post)->get();


            // $likepostid =  DB::table('post_post_like')
            //     ->join('posts', 'posts.id', '=', 'post_post_like.post_id')
            //     ->join('post_likes', 'post_likes.id', '=', 'post_post_like.post_like_id')
            //     ->select('post_likes.id')
            //     ->where('post_likes.user_id', Auth::user()->id)->get();
            // dd($likepostid);

            if ($result->isEmpty()) {
                $Like = new Like;
                $Like->user_id = Auth::user()->id;
                $Like->post_id = $post;
                $Like->save();

                $p =  Post::find($post);

                $notifi  = new Notification;
                $notifi->sender_id = Auth::user()->id;
                $notifi->receiver_id = $p->user->id;
                $notifi->post_id = $post;
                $notifi->message_data = "กดไลค์โพสต์ของคุณ";
                $notifi->save();
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

        $comm  = $this->text_comment[$post];
        $this->text_comment[$post] = "";

        $Comment = new Comment;
        $Comment->user_id = Auth::user()->id;
        $Comment->post_id = $post;
        $Comment->write_comment = $comm;
        $Comment->save();
    }

    public function mount(Request $request)
    {
        if (!empty($request->id)) {

            $post_id =   Crypt::decryptString($request->id);
            $this->postshow = Post::find($post_id);
        }
    }
}
