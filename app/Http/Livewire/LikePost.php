<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Post;
use App\Models\PostLike;
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

        $follows =  Following::where('user_id', Auth::id())->pluck('following_id')->toArray();

        $posts =  Post::where('user_id', Auth::id())->union(Post::whereIn('user_id', $follows))->orderBy('created_at','desc')->get();
  


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
            $result =  PostLike::withTrashed()->where('user_id', Auth::user()->id)->where('post_id', $post)->get();


            // $likepostid =  DB::table('post_post_like')
            //     ->join('posts', 'posts.id', '=', 'post_post_like.post_id')
            //     ->join('post_likes', 'post_likes.id', '=', 'post_post_like.post_like_id')
            //     ->select('post_likes.id')
            //     ->where('post_likes.user_id', Auth::user()->id)->get();
            // dd($likepostid);

            if ($result->isEmpty()) {
                $Like = new PostLike;
                $Like->user_id = Auth::user()->id;
                $Like->post_id = $post;
                $Like->save();

                
                $li =  PostLike::where('post_id', $post)->where('user_id', Auth::user()->id)->get();
                $p =  Post::find($post);

                // dd($li[0]->id);
                $p->postlikes()->attach($li[0]->id, ['post_like_id' => $li[0]->id]);
                // dd($li[0]->post_id);

               $notifi  = new Notification;
               $notifi->sender_id= Auth::user()->id;
                 $notifi->receiver_id = $p->user->id;
                 $notifi->post_id = $li[0]->post_id;
                 $notifi->message_data = "กดไลค์โพสต์ของคุณ";
                $notifi->save();



            } else {




                $re =   PostLike::onlyTrashed()->where('id', $result[0]->id)->get();
                if ($re->isEmpty()) {
                    $li =  PostLike::where('post_id', $post)->where('user_id', Auth::user()->id)->get();
                    $p =  Post::find($post);
                    // dd($li);
                    // $p->postlikes()->detach(['post_like_id' => $li[0]->id]);
                    // dd('เข้า');

                    //   $date=   date('Y-m-d H:i:s', time());
                    // dd( gettype($date));
                    $p->postlikes()->updateExistingPivot($li[0]->id, ['deleted_at' => Carbon::now()]);
                    PostLike::destroy($result[0]->id);
                    $this->fillColor = false;
                } else {

                    PostLike::withTrashed()->where('id', $result[0]->id)->restore();
                    $li =  PostLike::where('post_id', $post)->where('user_id', Auth::user()->id)->get();
                    $p =  Post::find($post);
                    $this->fillColor = true;
                    // dd($this->fillColor);
                    // $p->postlikes()->updateExistingPivot($p, ['deleted_at' => null]);
                    $p->postlikes()->updateExistingPivot($li[0]->id, ['deleted_at' => NULL]);
                }
            }
        } catch (\Exception $e) {

            return back();
        }
    }
    public function comment($post)
    {
        $posts =    Post::find($post);
        // dd(gettype( $post));
        // dd($this->text_comment);

        $comm  = $this->text_comment[$post];
        $this->text_comment[$post] = "";
        // $test = Post::find($post);
        $Comment = new Comment;
        $Comment->user_id = Auth::user()->id;
        $Comment->post_id = $post;
        $Comment->write_comment = $comm;
        $Comment->save();

        
    if($posts->user->id != Auth::user()->id){


        $notifi  = new Notification;
        $notifi->sender_id = Auth::user()->id;
        $notifi->receiver_id = $posts->user->id;
        $notifi->post_id = $post;
        $notifi->message_data = "คอมเมนต์โพสต์ของคุณ";
        $notifi->save();
        }
    }

    public function mount(Request $request){
        if (!empty($request->id)) {
       
            $post_id =   Crypt::decryptString($request->id);
            $this->postshow = Post::find($post_id);
        
        }
      
      
     
    }
}
